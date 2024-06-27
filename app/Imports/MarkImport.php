<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class MarkImport implements ToCollection
{

  protected $academic_year_id;
  protected $class_id;
  protected $total_students;
  protected $school_id;

  public function __construct($academic_year_id,$school_id,$total_students)
  {
    $this->academic_year_id = $academic_year_id;
    $this->class_id = 8;
    $this->total_students = $total_students;
    $this->school_id = $school_id;
  }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    { 
      try {
        DB::beginTransaction();
        foreach ($collection as $r => $row) 
        {
          if ($r > $this->total_students) {
            break;
          }
          $stud = [];
          $first_row = $collection[0];

          if ($r != 0) {
           $stud = explode(' - ', $row[0]);
           $student = Student::where(['symbol_no'=>$stud[0],'school_id'=>$this->school_id])->first();

           if ($student) {

             $marks=[];
             for ($index = 0; $index < count($first_row);) { 
              if($index > 0){

                $sub = explode('_', $first_row[$index]);
                $subject = Subject::find($sub[0]);
              // dd($subject);
                $mark = [];
                $mark['subject_id'] = $subject->id;
                $mark['student_id'] = $student->id;
                $mark['class_id'] = $this->class_id;
                $mark['attendance'] = 1;
                $mark['academic_year_id'] = $this->academic_year_id;

                if($subject->only_theory){
                  $mark['obt_th_mark'] = $row[$index];
                  $mark['obt_pr_mark'] = null;
                  $mark['obt_total_mark'] = $row[$index];
                  $mark['pr_attendance'] = 0;
                  $index = $index+1;
                }else{
                  $mark['obt_th_mark'] = $row[$index]; 
                  $mark['obt_pr_mark'] = $row[$index+1];
                  $mark['obt_total_mark'] = $mark['obt_th_mark'] + $mark['obt_pr_mark'];
                  $mark['pr_attendance'] = 1;
                  $index = $index+2;
                }


                if ($mark['obt_th_mark'] == null || $mark['obt_th_mark'] == 0 || $mark['obt_th_mark']=='-') {
                  $mark['attendance'] = 0;
                }else{
                  $mark['attendance'] = 1;
                }

                if ($mark['obt_th_mark'] == null || $mark['obt_th_mark'] == 0 || $mark['obt_th_mark']=='-') {
                  $mark['pr_attendance'] = 0;
                }else{
                  $mark['pr_attendance'] = 1;
                }

                array_push($marks, $mark);

              }else{
                $index++;
              }
            } 
          }
          foreach ($marks as  $markDetails) {
                // check for already import
            $mark = Mark::where(['student_id'=>$markDetails['student_id'],'class_id'=>$markDetails['class_id'],'subject_id'=>$markDetails['subject_id']])->get()->first();
            if ($mark) {
              unset($markDetails['class_id'],$markDetails['student_id'],$markDetails['subject_id']);
              $mark->update($markDetails);
            }else{
             Mark::create($markDetails);
           }
         }

       }
     }
     DB::commit();
   } catch (Exception $e) {
    DB::rollBack();
  }  

}

}
