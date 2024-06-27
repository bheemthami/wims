<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Setting;
use App\Models\AcademicYear;

use App\Managers\SettingManager;
use App\Managers\CommonDataManager;

use Sentinel;

class SettingController extends Controller
{

    protected $settingManager;
    protected $commonDataManager;

    function __construct(SettingManager $settingManager,
        CommonDataManager $commonDataManager
    ){
        $this->settingManager = $settingManager;
        $this->commonDataManager = $commonDataManager;
    }


    public function index()
    {

        try {

            if(Sentinel::hasAccess('settings.index')){

                $setting = $this->settingManager->defaultSetting();

                return  view('admin.setting.index',compact('setting'));
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

            if(Sentinel::hasAccess('settings.edit')){

                $setting = Setting::find($id);
                $academicYears =AcademicYear::pluck('year','id')->toArray(); 
                $year_options = [null=>'--Select Year--'] + $academicYears;

                return view('admin.setting.edit',compact('setting','year_options'));
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            if(Sentinel::hasAccess('settings.update')){

                $settingDetails = $request->only('system_name','system_short_name','tag_line','academic_year_id','municipality','office','office_address','province_name','province_no','phone','email','date_of_issue','sheet_issue_date','status','result_date','per_page');

                if($request->hasFile('logo')){
                    $file = $request->logo;
                    $folder = 'uploads/setting/';
                    $fileName = 'logo'.'.'.$file->getClientOriginalExtension();
                    $file->move($folder,$fileName);
                    $settingDetails['logo'] = $fileName;
                }

                if($request->hasFile('local_logo')){
                    $file = $request->local_logo;
                    $folder = 'uploads/setting/';
                    $fileName = 'local_logo'.'.'.$file->getClientOriginalExtension();
                    $file->move($folder,$fileName);
                    $settingDetails['local_logo'] = $fileName;
                }

                if($request->hasFile('favicon')){
                    $file = $request->favicon;
                    $folder = 'uploads/setting/';
                    $fileName = 'favicon'.'.'.$file->getClientOriginalExtension();
                    $file->move($folder,$fileName);
                    $settingDetails['favicon'] = $fileName;
                }

                Setting::where(['id'=>$id])->update($settingDetails);

                return redirect()->route('settings.index')->with('success','Updated Successfully!!!');
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
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
        //
    }

 // Fucntion Signature
    public function resultSettingEdit($terminal_id)
    {
       try {

        if(Sentinel::hasAccess('settings.update')){
            $terminal = $this->terminalManager->find($terminal_id);
            $resultStatusOptions = $this->commonDataManager->resultStatusDropdown();

            return view('admin.setting.results.edit',compact('terminal','resultStatusOptions'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
    }    
}

public function resultSettingUpdate(ResultSettingRequest $request, $terminal_id)
{

    try {

        if(Sentinel::hasAccess('result-settings.update')){
            $terminal = $this->terminalManager->find($terminal_id);
            $details = $request->only('school_open_days','date_of_issue','result_date','result_status');

            $terminal->update($details);
            
            return redirect()->route('settings.index')->with('success','Successfully updated!');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
    }    
}


    // Fucntion Signature
public function resultSettingCreate($terminal_id)
{
   try {

    if(Sentinel::hasAccess('settings.update')){

    }else{
        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    }

} catch (Exception $e) {
    return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
}    
}

}
