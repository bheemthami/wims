<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\QuickLinkRequest;

use App\Models\Frontend\QuickLink;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\QuickLinkManager;

use Sentinel;
use DB;

class QuickLinkController extends Controller
{
    protected $quickLinkManager;
    protected $commonDataManager;

    function __construct(
        QuickLinkManager $quickLinkManager,
        CommonDataManager $commonDataManager
    )
    {
        $this->quickLinkManager = $quickLinkManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();
                $params = request()->only('title');
                $quick_links = $this->quickLinkManager->all($params,$setting->per_page);
                return  view('site_modules.quick_links.replace_index',compact('quick_links'));
            }


            if(Sentinel::hasAccess('quick-links.index')){
                $setting = defaultSetting();
                $params['title'] = null;
                $quick_links = $this->quickLinkManager->all($params,$setting->per_page);
                return view('site_modules.quick_links.index',compact('quick_links'));
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

        if(Sentinel::hasAccess('quick-links.create')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $data['type_options'] = $this->commonDataManager->linkTypeDropdown();  
            return view('site_modules.quick_links.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(QuickLinkRequest $request)
{

    try {

        if(Sentinel::hasAccess('quick-links.store')){
            DB::beginTransaction();
            $details = $request->only('title','link','order','status','type');
            $quick_link = QuickLink::create($details);
            DB::commit();
            return redirect()->route('quick-links.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('quick-links.view')){
            $quick_link = QuickLink::find($id);
            return view('site_modules.quick_links.view',compact('quick_link'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($quick_link_id)
{

    try {

        if(Sentinel::hasAccess('quick-links.edit')){

            $data['setting'] = defaultSetting();
            
            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown(); 
            $data['type_options'] = $this->commonDataManager->linkTypeDropdown(); 
            $quick_link = QuickLink::find($quick_link_id);
            return view('site_modules.quick_links.edit',compact('data','quick_link'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

        
    } catch (Exception $e) {
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
    }

}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(QuickLinkRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('quick-links.update')){
            DB::beginTransaction();
            $details = $request->only('title','link','status','order','type');

            $quick_link = QuickLink::find($id);
            
            $quick_link->update($details);

            DB::commit();

            return redirect()->route('quick-links.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('quick-links.delete')){
            $quick_link = QuickLink::find($id);
            $quick_link->delete();            
            return redirect()->route('quick-links.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('quick-links.index')->with('error','Oops! Something went wrong.');
    }
}
}
