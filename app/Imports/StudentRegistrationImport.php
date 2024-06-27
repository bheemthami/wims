<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use DB;
use Validator;

use App\Models\Student;
use App\Models\Roll;

class StudentRegistrationImport implements ToCollection
{ 
	protected $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function collection(Collection $collection)
	{	

		try {
			DB::beginTransaction();
			// slice array from 2 index
			$collection = array_slice($collection->toArray(), 2,$this->data['total_students']);
			foreach ($collection as $key => $record) {

				$details = [];
				$details['symbol_no'] = getNextRegNo($this->data['academic_year_id'],$this->data['student_class_id']);
				$details['first_name'] = $record[1] ? strtoupper($record[1]):null;
				$details['middle_name'] = $record[2] ? strtoupper($record[2]):null;
				$details['last_name'] = $record[3] ? strtoupper($record[3]):null;
				$details['district'] = $record[4] ? ucfirst(strtolower($record[4])):null;

				$details['local_level_type_id'] = $record[5] ? getLocalLevelTypeById($record[5]):4;
				$details['municipality'] = $record[6] ? ucfirst($record[6]):null;

				$details['ward_no'] = $record[7] ? $record[7] :1;
				$details['father_name'] = $record[8] ? $record[8]:null;
				$details['mother_name'] = $record[9] ? $record[9]:null;
				$details['dob'] = $record[10] ? $record[10]:'0000-00-00';

				$validator = Validator::make($details,[
					'symbol_no' => 'required',
					'first_name' =>'required',
					'last_name' => 'required',
					'district' =>'required',
					'municipality'=>'required',
					'local_level_type_id'=>'required',
					'ward_no'=>'required',
					'father_name' =>'required',
					'mother_name' =>'required',
					'dob' => 'required',
				]);
				// validate data
				if($validator->passes()){

					if (strtolower($record[11]) =="m" || strtolower($record[11]) =="male") {
						$details['gender'] = 'Male';
					}else{
						$details['gender'] = 'Female';
					}

					$details['school_id'] = $this->data['school_id'];
					$details['academic_year_id'] = $this->data['academic_year_id'];
					$details['class_id'] = $this->data['student_class_id'];
					$details['register_date'] = date('Y-m-d',strtotime('today'));
					$student = Student::where(['symbol_no'=>$details['symbol_no'],'class_id'=>$details['class_id'],'academic_year_id'=>$details['academic_year_id']])->first();


					if ($student) {
						unset($details['symbol_no']);
						unset($details['school_id']);
						unset($details['academic_year_id']);
						$student->update($details);
					}else{
						$student = Student::create($details);
						$rollDetails = [];
						$rollDetails['academic_year_id'] = $this->data['academic_year_id'];
						$rollDetails['student_class_id'] = $this->data['student_class_id'];
						$rollDetails['section_id'] = $this->data['section_id'];
						$rollDetails['student_id'] = $student->id;
						$rollDetails['roll_no'] = getNextRollNo($rollDetails['academic_year_id'],$rollDetails['student_class_id'],$rollDetails['section_id']);
						Roll::create($rollDetails);
					}

				}

			}

			DB::commit();
			
		} catch (Exception $e) {
			DB::rollBack();
		}
	}
}
