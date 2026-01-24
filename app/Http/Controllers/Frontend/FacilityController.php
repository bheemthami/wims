<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\FacilityRequest;

use App\Models\Frontend\Facility;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\FacilityManager;
use App\Models\Frontend\Media;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    protected $commonDataManager;
    protected $facilityManager;

    function __construct(
        CommonDataManager $commonDataManager,
        FacilityManager $facilityManager,
    ) {
        $this->commonDataManager = $commonDataManager;
        $this->facilityManager = $facilityManager;
    }

    public function index()
    {
        try {

            $setting = defaultSetting();
            if (request()->ajax()) {
                $params = request()->only('title');
                $facilities = $this->facilityManager->all($params, $setting->perp_page);
                return  view('site_modules.facilities.replace_index', compact('facilities'));
            }

            if (Sentinel::hasAccess('facilities.index')) {
                $params['title'] = null;
                $facilities = $this->facilityManager->all($params, $setting->perp_page);
                return view('site_modules.facilities.index', compact('facilities'));
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

            if (Sentinel::hasAccess('facilities.create')) {

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.facilities.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {

        try {

            if (Sentinel::hasAccess('facilities.store')) {
                DB::beginTransaction();

                $details = $request->except('image', 'attachment');

                $details['slug'] = Str::slug($request->title);

                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/facilities/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $details['attachment'] = $fileName;
                }

                $facility = Facility::create($details);

                if ($request->hasFile('image')) {
                    $files = $request->image;

                    foreach ($files as $key => $file) {
                        $folder = 'uploads/media/';
                        $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                        $file->move($folder, $fileName);

                        $image = new Media();
                        $image->title = $request->title;
                        $image->image = $fileName;

                        $facility->images()->save($image);
                    }
                }

                DB::commit();
                return redirect()->route('facilities.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('facilities.view')) {
                $facility = Facility::find($id);
                return view('site_modules.facilities.view', compact('facility'));
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

            if (Sentinel::hasAccess('facilities.edit')) {

                $data['setting'] = defaultSetting();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $facility = Facility::with('images')->find($id);
                return view('site_modules.facilities.edit', compact('data', 'facility'));
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
    public function update(FacilityRequest $request, $id)
    {

        try {
            if (Sentinel::hasAccess('facilities.update')) {
                DB::beginTransaction();
                $details = $details = $request->except('image', 'attachment');
                $details['slug'] = Str::slug($request->title);

                $facility = Facility::find($id);
                $facility->update($details);

                $old_images = $facility->images;

                // store new uploaded images
                if ($request->hasFile('image')) {
                    $files = $request->image;

                    foreach ($files as $key => $file) {
                        $folder = 'uploads/media/';
                        $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                        $file->move($folder, $fileName);

                        $image = new Media();
                        $image->title = $request->title;
                        $image->image = $fileName;

                        $facility->images()->save($image);
                    }
                    // remove old image file
                    if ($old_images) {

                        foreach ($old_images as $img) {
                            $oldFilePath = public_path('uploads/media/' . $img->image);
                            if (File::exists($oldFilePath)) {
                                File::delete($oldFilePath);
                            }
                            $img->delete();
                        }
                    }
                }


                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/facilities/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_attachment = $facility->attachment;

                    $facility->update(['attachment' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/facilities/' . $old_attachment);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('facilities.index')->with('success', 'Operation Successfull');
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

            if (Sentinel::hasAccess('facilities.delete')) {
                $facility = Facility::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/facilities/' . $facility->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Remove  old attachment
                $oldPath = public_path('uploads/facilities/' . $facility->attachment);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $facility->delete();
                return redirect()->route('facilities.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $folder = public_path('uploads/facilities/');
            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $fileName);

            $url = asset('uploads/facilities/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
