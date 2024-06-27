<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Official;

use DB;

class OfficialManager
{
	protected $official;

	public function __construct(Official $official)
	{
		$this->official = $official;
	}

	public function all($params= null, $perPage){
		$query = $this->official::select('*'); 

		if($params['first_name']){
			$query = $query->where('first_name','like','%'.$params['first_name'].'%');
		}

		if($params['working_status']){
			$query = $query->where(['working_status'=>$params['working_status']]);
		}

		if($params['is_teaching_official']){
			$query = $query->where(['is_teaching_official'=>$params['is_teaching_official']]);
		}

		if($params['status']){
			$query = $query->where(['status'=>$params['status']]);
		}

		if($params['department_id']){
			$query = $query->where(['department_id'=>$params['department_id']]);
		}

		return  $officials = $query->orderBy('order','ASC')->paginate($perPage);

	}



	public function count($working_status = null, $is_teaching_official =null, $status = null, $department_id = null){
		$query = $this->official;

		if($working_status){
			$query = $query->where(['working_status'=>$working_status]);
		}

		if($is_teaching_official){
			$query = $query->where(['is_teaching_official'=>$is_teaching_official]);
		}

		if($status){
			$query = $query->where(['status'=>$status]);
		}

		if($department_id){
			$query = $query->where(['department_id'=>$department_id]);
		}

		return  $officials = $query->count();

	}

	public function publishedOfficials($department_id = null,){
		$query = $this->official::where(['status'=>1,'working_status'=>1]);

		if($department_id){
			$query = $query->where(['department_id'=>$department_id]);
		}

		$query->orderBy('order','ASC');

	
		return $query->get();
	}

	public function find($id){
		return $this->official::find($id);
	}

	
}
