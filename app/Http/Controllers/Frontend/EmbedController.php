<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\EmbedRequest;

use App\Managers\Frontend\EmbedManager;
use App\Managers\CommonDataManager;

use App\Models\Frontend\Embed;


use Sentinel;
use DB;

class EmbedController extends Controller
{
    protected $embedManager;
    protected $commonDataManager;

    function __construct(
        EmbedManager $embedManager,
        CommonDataManager $commonDataManager
    )
    {
        $this->embedManager = $embedManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();
                $params = request()->only('title');
                $embeddings = $this->embedManager->all($params,$setting->per_page);
                return  view('site_modules.embeddings.replace_index',compact('embeddings'));
            }


            if(Sentinel::hasAccess('embeddings.index')){
                $setting = defaultSetting();
                $params['title'] = null;
                $embeddings = $this->embedManager->all($params,$setting->per_page);
                return view('site_modules.embeddings.index',compact('embeddings'));
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

        if(Sentinel::hasAccess('embeddings.create')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $data['type_options'] = $this->commonDataManager->socialSiteTypeDropdown();  
            return view('site_modules.embeddings.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(EmbedRequest $request)
{

    try {

        if(Sentinel::hasAccess('embeddings.store')){
            DB::beginTransaction();
            $details = $request->only('title','type','iframe','status');
            $embed = Embed::create($details);
            DB::commit();
            return redirect()->route('embeddings.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('embeddings.view')){
            $embed = Embed::find($id);
            return view('site_modules.embeddings.view',compact('embed'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('embeddings.edit')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown(); 
            $data['type_options'] = $this->commonDataManager->socialSiteTypeDropdown();   
            $embed = Embed::find($id);
            return view('site_modules.embeddings.edit',compact('data','embed'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

        
    } catch (Exception $e) {
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
    }

}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(EmbedRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('embeddings.update')){
            DB::beginTransaction();
            $details = $request->only('title','type','iframe','status');
            $embed = Embed::find($id);
            $embed->update($details);
            DB::commit();
            return redirect()->route('embeddings.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('embeddings.delete')){
            $embed = Embed::find($id);
            $embed->delete();            
            return redirect()->route('embeddings.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('embeddings.index')->with('error','Oops! Something went wrong.');
    }
}
}
