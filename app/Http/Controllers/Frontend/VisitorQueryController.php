<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Managers\AcademicYearManager;
use App\Managers\SettingManager;

use App\Models\Frontend\VisitorQuery;

use Sentinel;
use Validator;

class VisitorQueryController extends Controller
{

    protected $academicYearManager;
    protected $settingManager;

    function __construct(AcademicYearManager $academicYearManager,SettingManager $settingManager)
    {
        $this->academicYearManager = $academicYearManager;
        $this->settingManager = $settingManager;
    }


    public function index()
    {
        try {

            if(Sentinel::hasAccess('visitor-queries.index')){
                $setting = defaultSetting();
                $visitor_queries = VisitorQuery::orderBy('created_at','ASC')->paginate($setting->per_page);
                return view('site_modules.visitor_queries.index',compact('visitor_queries'));
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
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

            if (request()->ajax()) {
               $details = request()->only('name','email','phone','subject','message');
               dd($details);
           }

           if(Sentinel::hasAccess('visitor-queries.create')){

            $gradingSystemOptions = $this->commonDataManager->gradingSystemDropdown();

            return view('site_modules.visitor_queries.create',compact('gradingSystemOptions'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicYearRequest $request)
    {
       try {

        if(Sentinel::hasAccess('visitor-queries.store')){

            $requestDetails = $request->except('_token');
            VisitorQuery::create($requestDetails);
            return redirect('admin/visitor-queries')->with('success','Successfully Created!');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
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

            if(Sentinel::hasAccess('visitor-queries.store')){

                $visitor_query = VisitorQuery::find($id);

                return view('site_modules.visitor_queries.view',compact('visitor_query'));
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
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

            if(Sentinel::hasAccess('visitor-queries.edit')){
                $visitor_query = VisitorQuery::find($id);
                $gradingSystemOptions = $this->commonDataManager->gradingSystemDropdown();
                return view('site_modules.visitor_queries.edit',compact('academic_year','gradingSystemOptions'));
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicYearRequest $request, $id)
    {

        try {
            if(Sentinel::hasAccess('visitor-queries.update')){
                $visitor_query = VisitorQuery::find($id);
                $updateData = $request->except('_token');
                $visitor_query->update($updateData);
                return redirect('admin/visitor-queries')->with('success','Successfully Updated!');
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
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
            if(Sentinel::hasAccess('visitor-queries.delete')){
                $students_count = Student::where(['academic_year_id'=>$id])->get();
                if(count($students_count) > 0){
                    return redirect('admin/visitor-queries')->with('error','Deletion not allowed');
                }
                VisitorQuery::where(['id'=>$id])->delete();
                return redirect('admin/visitor-queries')->with('success','Successfully Deleted!');
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            
        } catch (Exception $e) {
            return redirect('admin/visitor-queries')->with('error','Oops! Something went wrong.');
        }
        
    }

    public function collectQueries(Request $request)
    {

        try {


            if ($request->ajax()) {
                $settings = $this->settingManager->defaultSetting();

                $validator = Validator::make($request->all(), [
                   'name'=>'required',
                   'email'=>'required|email',
                   'phone'=>'required',
                   'subject'=>'required',
                   'message'=>'required'
               ]);

                if (!$validator->fails()) {
                    $details = $request->only(['name','email','phone','subject','message']);

                    $details['academic_year_id'] = $settings->academic_year_id;
                    $details['qid'] = $this->nextID();
                    VisitorQuery::create($details);
                    return response()->json(['status'=>'ok']);
                } else {
                    return response()->json($validator->errors());
                }
                
            } 

        } catch (Exception $e) {
            return redirect('index')->with('error','Oops! Something went wrong.');
        }
    }

    public function nextID(){

        do{
            $qid = rand(1000000000,9999999999);
        } while(!$this->isQidUnique($qid));

        return $qid;

    }

    public function isQidUnique($qid){

        $qid = VisitorQuery::where(['qid'=>$qid])->get();

        if ($qid) {
            return true;
        }
        return false;
    }

}
