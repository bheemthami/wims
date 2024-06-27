<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Training;

use DB;

class TrainingManager
{
	protected $training;

	public function __construct(Training $training)
	{
		$this->training = $training;
	}

	public function all($params= null, $perPage){
		$query = $this->training::select('*'); 

		if($params['title']){
			$query = $query->where('title','like','%'.$params['title'].'%');
		}

		if($params['training_type_id']){
			$query = $query->where(['training_type_id'=>$params['training_type_id']]);
		}

		if($params['training_category_id']){
			$query = $query->where(['training_category_id'=>$params['training_category_id']]);
		}

		return  $trainings = $query->orderBy('order','ASC')->paginate($perPage);

	}

	public function count($training_type_id = null, $training_category_id = null, $status = null){
		$query = $this->training::select('*'); 


		if($training_type_id){
			$query = $query->where(['training_type_id'=>$training_type_id]);
		}

		if($training_category_id){
			$query = $query->where(['training_category_id'=>$training_category_id]);
		}

		if($status){
			$query = $query->where(['status'=>$status]);
		}

		return  $query->count();

	}

	public function publishedTrainings($training_type_id =null,$training_category_id = null){
		$query = $this->training::where(['status'=>1])->orderBy('order','ASC');

		if($training_type_id){
			$query = $query->where(['training_type_id'=>$training_type_id]);
		}

		if($training_category_id){
			$query = $query->where(['training_category_id'=>$training_category_id]);
		}
		
		return $query->get();
	}

	public function topPublishedTrainings($training_type_id =null,$training_category_id = null,$limit = null){
		$query = $this->training::where(['status'=>1])->orderBy('order','ASC');

		if($training_type_id){
			$query = $query->where(['training_type_id'=>$training_type_id]);
		}

		if($training_category_id){
			$query = $query->where(['training_category_id'=>$training_category_id]);
		}

		if ($limit) {
			$query->limit($limit);
		}
		return $query->get();
	}

	public function find($id){
		return $this->training::find($id);
	}


	public function getTrainingBySlug($slug){
		return $this->training::where(['slug'=>$slug])->first();
	}


	public function publishedTrainingBySlug($slug,$id){
		return $this->training::where(['slug'=>$slug,'id'=>$id])->first();
	}

	
}
