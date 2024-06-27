<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\TrainingRequest;

use App\Models\Frontend\Training;

use App\Managers\CommonDataManager;
use App\Managers\AcademicYearManager;
use App\Managers\Frontend\TrainingCategoryManager;
use App\Managers\Frontend\TrainingTypeManager;
use App\Managers\Frontend\TrainingManager;

use Sentinel;
use DB;
use Str;
use File;

class TrainingController extends Controller
{
    protected $commonDataManager;
    protected $settingManager;
    protected $trainingManager;
    protected $trainingCategoryManager;
    protected $trainingTypeManager;

    function __construct(
        CommonDataManager $commonDataManager,
        TrainingCategoryManager $trainingCategoryManager,
        TrainingTypeManager $trainingTypeManager,
        TrainingManager $trainingManager,
    )
    {
        $this->commonDataManager = $commonDataManager;
        $this->trainingTypeManager = $trainingTypeManager;
        $this->trainingCategoryManager = $trainingCategoryManager;
        $this->trainingManager = $trainingManager;
    }

    public function index()
    {
        try {

            $setting = defaultSetting();
            $trainingCategoryOptions = $this->trainingCategoryManager->dropdown();
            $trainingTypeOptions = $this->trainingTypeManager->dropdown();

            if (request()->ajax()) {

               $params = request()->only('title','training_category_id','training_type_id');
               $trainings = $this->trainingManager->all($params,$setting->academic_year_id,$setting->perp_page);

               return  view('site_modules.trainings.replace_index',compact('trainings','trainingCategoryOptions','trainingTypeOptions','setting'));
           }


           if(Sentinel::hasAccess('trainings.index')){
            $params['title'] = null;
            $params['training_category_id'] = null;
            $params['training_type_id'] = null;
            $trainings = $this->trainingManager->all($params,$setting->perp_page);

            return view('site_modules.trainings.index',compact('trainings','trainingCategoryOptions','trainingTypeOptions','setting'));

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

        if(Sentinel::hasAccess('trainings.create')){

            $data['setting'] = defaultSetting();
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $data['training_category_options'] = $this->trainingCategoryManager->dropdown();  
            $data['training_type_options'] = $this->trainingTypeManager->dropdown();  
            return view('site_modules.trainings.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(TrainingRequest $request)
{

    try {

        if(Sentinel::hasAccess('trainings.store')){
            DB::beginTransaction();

            $trainingDetails = $request->except('image','attachment');

            $trainingDetails['slug'] = Str::slug($request->title);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/trainings/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);
                $trainingDetails['image'] = $fileName;
            }

            if($request->hasFile('attachment')){
                $file = $request->attachment;
                $folder = 'uploads/trainings/';
                $fileName = 'attachment-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);
                $trainingDetails['attachment'] = $fileName;
            }
            $training = Training::create($trainingDetails);
            DB::commit();
            return redirect()->route('trainings.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('trainings.view')){
            $training = Training::find($id);            
            return view('site_modules.trainings.view',compact('training'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('trainings.edit')){

            $data['setting'] = defaultSetting();
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $data['training_category_options'] = $this->trainingCategoryManager->dropdown();  
            $data['training_type_options'] = $this->trainingTypeManager->dropdown();  
            $training = Training::find($id);
            return view('site_modules.trainings.edit',compact('data','training'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

        
    } catch (Exception $e) {
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
    }

}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(TrainingRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('trainings.update')){
            DB::beginTransaction();
            $trainingDetails = $trainingDetails = $request->except('image','attachment');
            $trainingDetails['slug'] = Str::slug($request->title);
            $training = Training::find($id);
            $training->update($trainingDetails);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/trainings/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);

                $old_image = $training->image;

                $training->update(['image'=>$fileName]);

                // Remove  old file
                $oldFilePath = public_path('uploads/trainings/'.$old_image);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }


            if($request->hasFile('attachment')){
                $file = $request->attachment;
                $folder = 'uploads/trainings/';
                $fileName = 'attachment-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);

                $old_attachment = $training->attachment;

                $training->update(['attachment'=>$fileName]);

                // Remove  old file
                $oldFilePath = public_path('uploads/trainings/'.$old_attachment);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            DB::commit();

            return redirect()->route('trainings.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('trainings.delete')){
            $training = Training::find($id);

            // Remove  old file
            $oldPath = public_path('uploads/trainings/'.$training->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Remove  old attachment
            $oldPath = public_path('uploads/trainings/'.$training->attachment);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $training->delete();            
            return redirect()->route('trainings.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('trainings.index')->with('error','Oops! Something went wrong.');
    }
}


public function uploadimage(Request $request)
{

    if($request->hasFile('upload')){
        $file = $request->file('upload');
        $folder = public_path('uploads/trainings/');
        $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
        $file->move($folder,$fileName);

        $url = asset('uploads/trainings/'.$fileName);
        return response()->json(['fileName'=>$fileName,'uploaded'=>1,'url'=>$url]);
    }
}
}
