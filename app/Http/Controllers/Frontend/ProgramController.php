<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\ProgramRequest;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\Frontend\ProgramManager;

use App\Models\Frontend\Program;

use Sentinel;
use DB;
use Str;
use File;

class ProgramController extends Controller
{
    protected $commonDataManager;
    protected $settingManager;
    protected $programManager;

    function __construct(
        CommonDataManager $commonDataManager,
        SettingManager $settingManager,
        ProgramManager $programManager,
    )
    {
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
        $this->programManager = $programManager;
    }

    public function index()
    {
        try {

            $setting = defaultSetting();

            if (request()->ajax()) {
                $params['title'] = request()->title;
               $programs = $this->programManager->all($params,$setting->academic_year_id,$setting->perp_page);

               return  view('site_modules.programs.replace_index',compact('programs','setting'));
           }


           if(Sentinel::hasAccess('programs.index')){
            $params['title'] = null;

            $programs = $this->programManager->all($params,$setting->perp_page);

            return view('site_modules.programs.index',compact('programs','setting'));

        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');

    } catch (Exception $e) {
        return redirect()->back()->with('error','Oops, Something went wrong!!!');
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

        if(Sentinel::hasAccess('programs.create')){

            $data['setting'] = defaultSetting();
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            return view('site_modules.programs.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('dashboard.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(ProgramRequest $request)
{

    try {

        if(Sentinel::hasAccess('programs.store')){
            DB::beginTransaction();

            $details = $request->except('image','attachment');

            $details['slug'] = Str::slug($request->title);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/programs/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);
                $details['image'] = $fileName;
            }

            if($request->hasFile('attachment')){
                $file = $request->attachment;
                $folder = 'uploads/programs/';
                $fileName = 'attachment-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);
                $details['attachment'] = $fileName;
            }
            $program = Program::create($details);
            DB::commit();
            return redirect()->route('programs.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('programs.view')){
            $program = Program::find($id);            
            return view('site_modules.programs.view',compact('program'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('programs.edit')){

            $data['setting'] = defaultSetting();
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $program = Program::find($id);
            return view('site_modules.programs.edit',compact('data','program'));
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
public function update(ProgramRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('programs.update')){
            DB::beginTransaction();
            $details = $details = $request->except('image','attachment');
            
            $details['slug'] = Str::slug($request->title);

            $program = Program::find($id);
            
            $program->update($details);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/programs/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);

                $old_image = $program->image;

                $program->update(['image'=>$fileName]);

                // Remove  old file
                $oldFilePath = public_path('uploads/programs/'.$old_image);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }


            if($request->hasFile('attachment')){
                $file = $request->attachment;
                $folder = 'uploads/programs/';
                $fileName = 'attachment-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);

                $old_attachment = $program->attachment;

                $program->update(['attachment'=>$fileName]);

                // Remove  old file
                $oldFilePath = public_path('uploads/programs/'.$old_attachment);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            DB::commit();

            return redirect()->route('programs.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
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

    try {

        if(Sentinel::hasAccess('programs.delete')){
            $program = Program::find($id);

            // Remove  old file
            $oldPath = public_path('uploads/programs/'.$program->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Remove  old attachment
            $oldPath = public_path('uploads/programs/'.$program->attachment);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $program->delete();            
            return redirect()->route('programs.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
    }
}


public function uploadimage(Request $request)
{

    if($request->hasFile('upload')){
        $file = $request->file('upload');
        $folder = public_path('uploads/programs/');
        $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
        $file->move($folder,$fileName);

        $url = asset('uploads/programs/'.$fileName);
        return response()->json(['fileName'=>$fileName,'uploaded'=>1,'url'=>$url]);
    }
}

}
