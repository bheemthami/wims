<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\OfficialRequest;
use App\Models\Frontend\Official;

use App\Managers\LocalLevelTypeManager;
use App\Managers\CommonDataManager;
use App\Managers\AcademicYearManager;
use App\Managers\DesignationManager;
use App\Managers\SettingManager;
use App\Managers\Frontend\DepartmentManager;
use App\Managers\Frontend\OfficialManager;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OfficialController extends Controller
{
    protected $localLevelTypeManager;
    protected $academicYearManager;
    protected $commonDataManager;
    protected $designationManager;
    protected $settingManager;
    protected $officialManager;
    protected $departmentManager;

    function __construct(
        LocalLevelTypeManager $localLevelTypeManager,
        AcademicYearManager $academicYearManager,
        CommonDataManager $commonDataManager,
        DesignationManager $designationManager,
        SettingManager $settingManager,
        OfficialManager $officialManager,
        DepartmentManager $departmentManager
    ) {
        $this->academicYearManager = $academicYearManager;
        $this->localLevelTypeManager = $localLevelTypeManager;
        $this->commonDataManager = $commonDataManager;
        $this->designationManager = $designationManager;
        $this->settingManager = $settingManager;
        $this->officialManager = $officialManager;
        $this->departmentManager = $departmentManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();
            $data['department_options'] = $this->departmentManager->dropdown();
            $data['working_status_options'] = $this->commonDataManager->yesNoDropdown();
            $data['teaching_status_options'] = $this->commonDataManager->yesNoDropdown();
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();

            $search_params['department_id'] = null;
            $search_params['working_status'] = null;
            $search_params['is_teaching_official'] = null;
            $search_params['status'] = null;
            $search_params['first_name'] = null;

            if (request()->ajax()) {
                $search_params = request()->only('first_name', 'department_id', 'working_status', 'is_teaching_official', 'status');
                $officials = $this->officialManager->all($search_params, $setting->per_page);
                return view('site_modules.officials.replace_index', compact('officials', 'data'));
            }


            if (Sentinel::hasAccess('officials.index')) {
                $officials = $this->officialManager->all($search_params, $setting->per_page);
                return view('site_modules.officials.index', compact('officials', 'data'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, Something went wrong!!!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {

            if (Sentinel::hasAccess('officials.create')) {

                $data['setting'] = defaultSetting();
                $data['year_options'] =  $this->academicYearManager->dropdown();
                $data['gender_options'] = $this->commonDataManager->genderDropdown();
                $data['lltype_options'] = $this->localLevelTypeManager->dropdown();
                $data['department_options'] = $this->departmentManager->dropdown();
                $data['designation_options'] = $this->designationManager->dropdown();
                $data['working_status_options'] = $this->commonDataManager->yesNoDropdown();
                $data['teaching_status_options'] = $this->commonDataManager->yesNoDropdown();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['yes_no_options'] = $this->commonDataManager->yesNoDropdown();
                return view('site_modules.officials.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficialRequest $request)
    {

        try {

            if (Sentinel::hasAccess('officials.store')) {
                DB::beginTransaction();
                $details = $request->except('_method', '_token', 'image');
                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/officials/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $details['image'] = $fileName;
                }
                Official::create($details);
                DB::commit();
                return redirect()->route('officials.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            if (Sentinel::hasAccess('officials.view')) {

                $official = Official::find($id);
                $user = Sentinel::findByCredentials(['login' => $official->email]);
                return view('site_modules.officials.view', compact('official', 'user'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {

            if (Sentinel::hasAccess('officials.edit')) {

                $data['setting'] = defaultSetting();
                $data['year_options'] =  $this->academicYearManager->dropdown();
                $data['gender_options'] = $this->commonDataManager->genderDropdown();
                $data['lltype_options'] = $this->localLevelTypeManager->dropdown();
                $data['department_options'] = $this->departmentManager->dropdown();
                $data['designation_options'] = $this->designationManager->dropdown();
                $data['working_status_options'] = $this->commonDataManager->yesNoDropdown();
                $data['teaching_status_options'] = $this->commonDataManager->yesNoDropdown();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['yes_no_options'] = $this->commonDataManager->yesNoDropdown();
                $official = Official::find($id);
                return view('site_modules.officials.edit', compact('data', 'official'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficialRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('officials.update')) {
                DB::beginTransaction();
                $details = $request->except('image', '_token', '_method');
                $official = Official::find($id);

                $official->update($details);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/officials/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $official->image;

                    $official->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/officials/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('officials.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            if (Sentinel::hasAccess('officials.delete')) {
                $official = Official::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/officials/' . $official->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $official->delete();
                return redirect()->route('officials.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    public  function officialAssign($id)
    {
        dd($id);
    }



    public function createLoginAccount($id)
    {

        try {

            if (Sentinel::hasAccess('officials.create-login-account')) {

                DB::beginTransaction();
                $official = Official::find($id);

                $userDetails['first_name'] = $official->first_name;
                $userDetails['last_name'] = $official->last_name;

                $user = Sentinel::findByCredentials(['login' => $official->email]);

                if ($user) {
                    return redirect()->route('officials.index')->with('warning', 'User account has been already created.');
                }

                $userDetails['email'] = $official->email;
                $userDetails['password'] = 'password';
                $user = Sentinel::registerAndActivate($userDetails);
                $role = Sentinel::findRoleBySlug('official');
                $role->users()->attach($user);
                DB::commit();
                return redirect()->route('users.index')->with('success', 'Successfully created.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
