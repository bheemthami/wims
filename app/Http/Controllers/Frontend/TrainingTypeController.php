<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\TrainingTypeRequest;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\TrainingTypeManager;

use App\Models\Frontend\TrainingType;

use Sentinel;
use DB;
use Str;

class TrainingTypeController extends Controller
{
    protected $trainingTypeManager;
    protected $commonDataManager;

    function __construct(
        TrainingTypeManager $trainingTypeManager,
        CommonDataManager $commonDataManager
    )
    {
        $this->trainingTypeManager = $trainingTypeManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();
                $params = request()->only('title');
                $training_types = $this->trainingTypeManager->all($params,$setting->per_page);
                return  view('site_modules.training_types.replace_index',compact('training_types'));
            }


            if(Sentinel::hasAccess('training-types.index')){
                $setting = defaultSetting();
                $params['title'] = null;
                $training_types = $this->trainingTypeManager->all($params,$setting->per_page);
                return view('site_modules.training_types.index',compact('training_types'));
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

        if(Sentinel::hasAccess('training-types.create')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();  
            return view('site_modules.training_types.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(TrainingTypeRequest $request)
{

    try {

        if(Sentinel::hasAccess('training-types.store')){
            DB::beginTransaction();
            $details = $request->only('title','order','status');
            $details['slug'] = Str::slug($request->title);
            $training_type = TrainingType::create($details);
            DB::commit();
            return redirect()->route('training-types.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('training-types.view')){
            $training_type = TrainingType::find($id);
            return view('site_modules.training_types.view',compact('training_type'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($training_type_id)
{

    try {

        if(Sentinel::hasAccess('training-types.edit')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();  
            $training_type = TrainingType::find($training_type_id);
            return view('site_modules.training_types.edit',compact('data','training_type'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

        
    } catch (Exception $e) {
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
    }

}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(TrainingTypeRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('training-types.update')){
            DB::beginTransaction();
            $details = $request->only('title','status','order');
            $details['slug'] = Str::slug($request->title);

            $training_type = TrainingType::find($id);
            
            $training_type->update($details);

            DB::commit();

            return redirect()->route('training-types.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
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


        if(Sentinel::hasAccess('training-types.delete')){
            $training_type = TrainingType::find($id);
            if (count($training_type->trainings) > 0) {
                return redirect()->route('training-types.index')->with('warning','This data is used in another table.');
            }

            $training_type->delete();            
            return redirect()->route('training-types.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('training-types.index')->with('error','Oops! Something went wrong.');
    }
}
}
