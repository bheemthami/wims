<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AcademicYearRequest;
use App\Http\Requests\BulkTerminalRequest;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Terminal;

use App\Managers\AcademicYearManager;
use App\Managers\CommonDataManager;

use Sentinel;

class AcademicYearController extends Controller
{



    protected $attedanceManager;
    protected $commonDataManager;

    public function __construct(
        AcademicYearManager $academicYearManager,
        CommonDataManager $commonDataManager

    ){

        $this->academicYearManager = $academicYearManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {

            if(Sentinel::hasAccess('academic-years.index')){
                $setting = defaultSetting();
                $aca_years = AcademicYear::orderBy('year','ASC')->paginate($setting->academic_year_id);
                return view('admin.academic_year.index',compact('aca_years'));
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
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

            if(Sentinel::hasAccess('academic-years.create')){

                $gradingSystemOptions = $this->commonDataManager->gradingSystemDropdown();

                return view('admin.academic_year.create',compact('gradingSystemOptions'));
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
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

        if(Sentinel::hasAccess('academic-years.store')){

            $requestDetails = $request->except('_token');
            AcademicYear::create($requestDetails);
            return redirect('admin/academic-years')->with('success','Successfully Created!');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
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

            if(Sentinel::hasAccess('academic-years.edit')){
            $academic_year = AcademicYear::find($id);
            $gradingSystemOptions = $this->commonDataManager->gradingSystemDropdown();
            return view('admin.academic_year.edit',compact('academic_year','gradingSystemOptions'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
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
            if(Sentinel::hasAccess('academic-years.update')){
                $academic_year = AcademicYear::find($id);
                $updateData = $request->except('_token');
                $academic_year->update($updateData);
                return redirect('admin/academic-years')->with('success','Successfully Updated!');
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
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
            if(Sentinel::hasAccess('academic-years.delete')){
                $students_count = Student::where(['academic_year_id'=>$id])->get();
                if(count($students_count) > 0){
                    return redirect('admin/academic-years')->with('error','Deletion not allowed');
                }
                AcademicYear::where(['id'=>$id])->delete();
                return redirect('admin/academic-years')->with('success','Successfully Deleted!');
            }

            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            
        } catch (Exception $e) {
            return redirect('admin/academic-years')->with('error','Oops! Something went wrong.');
        }
        
    }


    public function getDataByYear()
    {

       $academic_year_id = request()->aid;

       if (request()->ajax()) {
        $academic_year_id = request()->aid;
        $year = AcademicYear::find($academic_year_id);

        return response()->json(['status'=>'OK','no_of_exams'=>$year->no_of_exams]);
    }
}


public function createTerminals($academic_year_id)
{
    $year = AcademicYear::find($academic_year_id);


    if(count($year->terminals) == $year->no_of_exams){
        return redirect()->route('academic-years.index')->with('warning','Already created the terminals.');
    }
    $exams = [];
    for ($i=0; $i < $year->no_of_exams ; $i++) { 
     $exams[$i] = $i;
 }
 return view('admin.terminals.create_terminals',compact('year','exams'));
}

public function storeTerminals(BulkTerminalRequest $request)
{
    $year = AcademicYear::find($request->academic_year_id);

    foreach ($request->exams as $exam) {
        $examDetails = [];
        $examDetails = $exam;
        $examDetails['slug'] = str_slug($exam['term']);
        $examDetails['academic_year_id'] = $request->academic_year_id;
        Terminal::create($examDetails);
    }
    return redirect()->route('academic-years.index')->with('success','Created Successfully.');
}
}
