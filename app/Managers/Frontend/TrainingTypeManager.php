<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\TrainingType;

use DB;

class TrainingTypeManager
{
	protected $trainingType;

	public function __construct(TrainingType $trainingType)
	{
		$this->trainingType = $trainingType;
	}

	public function all($params = null,$perPage,$status = null){
		$query = $this->trainingType::select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->orderBy('order','ASC')->paginate($perPage);
	}

	public function count($status = null){
		$query = $this->trainingType;

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->trainingType::find($id);
	}


	public function dropdown(){
		return [null => '----'] + $this->trainingType::orderBy('order','ASC')->pluck('title','id')->toArray();
	}


	public function publishedTrainingTypes(){
		return $this->trainingType::where(['status'=>1])->orderBy('created_at','ASC')->get();
	}


	public function getTrainingTypesBySlug($slug){
		return $this->trainingType::where(['slug'=>$slug])->first();
	}


	public function publishedTrainingTypesBySlug($slug,$id){
		return $this->trainingType::where(['slug'=>$slug,'id'=>$id])->first();
	}
	
}
