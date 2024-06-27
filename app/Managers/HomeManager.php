<?php

namespace App\Managers;

use DB;
use Sentinel;

use App\Models\AcademicYear;
use App\Models\StudentClass;
use App\Models\ClassTeacher;

class HomeManager
{

	
	public function studentChart($academic_year_id = null,$student_class_id = null)
	{
		$query = DB::table('students')->select('students.id','rolls.academic_year_id','rolls.student_class_id','rolls.is_upgraded')
		->join('rolls','rolls.student_id','=','students.id')
		->join('academic_years','rolls.academic_year_id','=','academic_years.id');
		$query->select(DB::raw("IFNULL(SUM(gender='Male'),0) AS boys,IFNULL(SUM(gender='Female'),0) AS girls,COUNT(symbol_no) AS total,rolls.academic_year_id"));


		if ($academic_year_id) {
			$query->where(['rolls.academic_year_id'=>$academic_year_id]);
		}

		if ($student_class_id) {
			$query->where(['rolls.student_class_id'=>$student_class_id]);
		}


		$rd = $query->groupBy('rolls.academic_year_id')->get();

		$chartjs = [];
		$boys = [];
		$girls = [];
		$total = [];
		$labels = [];

		foreach ($rd as $key => $value) {
			$y = AcademicYear::find($value->academic_year_id)->year;
			array_push($labels,$y);

			array_push($boys, (int) $value->boys);
			array_push($girls, (int) $value->girls);
			array_push($total, (int) $value->total);
		}

		$chartjs['labels'] = $labels;
		$chartjs['boys'] = $boys;
		$chartjs['girls'] = $girls;
		$chartjs['total'] = $total;
		$chartjs = json_encode($chartjs);

		return $chartjs;

	}


	

	public function countStudents($academic_year_id){
		$scs = StudentClass::orderBy('order','ASC')->get();
		$classes = [];

		$user = Sentinel::getUser();
		$userRole = DB::table('role_users')->where(['user_id'=>$user->id])->first();
		$role = Sentinel::findRoleById($userRole->role_id);

		foreach($scs as $key => $class){
			$ct = [];
			$classes[$key]['class'] = $class;


			if($role->slug === 'teacher'){

				$ct = ClassTeacher::select('*')->join('teachers','class_teachers.teacher_id','=','teachers.id')->where(['class_teachers.academic_year_id'=>$academic_year_id,'class_teachers.student_class_id'=>$class->id,'teachers.email'=>$user->email])->get();

			}else{
				$ct = ClassTeacher::where(['academic_year_id'=>$academic_year_id,'student_class_id'=>$class->id])->get();
			}

			$students = DB::table('students')->join('rolls','students.id','=','rolls.student_id')->where(['rolls.academic_year_id'=>$academic_year_id,'rolls.student_class_id'=>$class->id])->get();
			$classes[$key]['students'] = $students;
			$classes[$key]['class_teacher'] = $ct;
		}

		return $classes;
	}


	public function admissionData($academic_year_id)
	{

		$data = [];
		$returnData = [];
		$query = DB::table('students')->select('students.id','rolls.academic_year_id','rolls.student_class_id','rolls.is_upgraded')
		->join('rolls','rolls.student_id','=','students.id')
		->join('academic_years','rolls.academic_year_id','=','academic_years.id');

		$query->where(['rolls.academic_year_id'=>$academic_year_id,'rolls.is_admitted'=>1]);

		$query->select(DB::raw("IFNULL(SUM(gender='Male'),0) AS boys,IFNULL(SUM(gender='Female'),0) AS girls,COUNT(symbol_no) AS total,rolls.student_class_id"));

		$rows = $query->groupBy('rolls.student_class_id')->get();

		$scs = StudentClass::orderBy('order','ASC')->get();

		foreach ($scs as $key => $class) {
			$data[$key]['id'] = $class->id;
			$data[$key]['class'] = $class->class;
			$data[$key]['name'] = $class->name;

			if (count($rows)>0) {

				foreach($rows as $row){



					if ($class->id == $row->student_class_id) {
						$data[$key]['boys'] = $row->boys;
						$data[$key]['girls'] = $row->girls;
						$data[$key]['total'] = $row->total;
						break;
					}else{
						$data[$key]['boys'] = 0;
						$data[$key]['girls'] = 0;			
						$data[$key]['total'] = 0;
					}
				}

			}else{
				$data[$key]['boys'] = 0;
				$data[$key]['girls'] = 0;			
				$data[$key]['total'] = 0;
			}

		}


		$total_boys = 0;
		$total_girls = 0;
		$grand_total = 0;

		foreach($rows as $row){
			$total_boys += $row->boys;
			$total_girls += $row->girls;
			$grand_total += $row->total;
		}

		$returnData['data'] = $data;
		$returnData['total']['boys'] = $total_boys;
		$returnData['total']['girls'] = $total_girls;
		$returnData['total']['total'] = $grand_total;

		return $returnData;
	}

}
