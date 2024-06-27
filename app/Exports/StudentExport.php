<?php

namespace App\Exports;

use App\Models\LocalSubject;
use App\Models\SchoolWiseSubject;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection,WithHeadings
{
	protected $student_class_id;
	protected $academic_year_id;

	public function __construct($student_class_id,$academic_year_id)
	{
		$this->student_class_id = $student_class_id;
		$this->academic_year_id = $academic_year_id;
	}

	public function collection()
	{

		$students  = Student::where(['student_class_id'=>$this->student_class_id,'academic_year_id'=>$this->academic_year_id])->selectRaw("CONCAT_WS(' ',symbol_no,'-',first_name,middle_name,last_name) AS full_name")->get();
		return $students;
	}

	public function headings(): array
	{

		$header = [
			'Full name',
		];

		$sub = SchoolWiseSubject::join('subjects','subjects.id','=','subject_id')->where(['school_id'=>$this->school_id,'academic_year_id'=>$this->academic_year_id])->orderBy('order','ASC')->get();
		if($sub->count() >= 9){
			$subjects = $sub;
		}else{
			$subjects = Subject::where(['is_local'=>0])->orderBy('order','ASC')->get();

			$ls = LocalSubject::with('subject')->where(['school_id'=>$this->school_id,'academic_year_id'=>$this->academic_year_id])->get();

			if ($ls) {
				foreach ($ls as $l) {
					$subjects->push($l->subject);
				}
			}
		}
		
		if ($subjects) {
			foreach ($subjects as $subject) {
				if(!$subject->only_theory){
					array_push($header, $subject->id.'_'.$subject->short_name.'_th_mark');
					array_push($header, $subject->id.'_'.$subject->short_name.'_pr_mark');
				}else{
					array_push($header, $subject->id.'_'.$subject->short_name.'_th_mark');
				}
			}
		}
		return $header;
	}
}
