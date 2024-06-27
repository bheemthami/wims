<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\TrainingCategory;

use DB;

class TrainingCategoryManager
{
	protected $trainingCategory;

	public function __construct(TrainingCategory $trainingCategory)
	{
		$this->trainingCategory = $trainingCategory;
	}

	public function all($params = null,$perPage,$status = null){
		$query = $this->trainingCategory::select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->orderBy('order','ASC')->paginate($perPage);
	}

	public function count($status = null){
		$query = $this->trainingCategory;

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->trainingCategory::find($id);
	}


	public function dropdown(){
		return [null => '----'] + $this->trainingCategory::orderBy('order','ASC')->pluck('title','id')->toArray();
	}


	public function publishedTrainingCategories(){
		return $this->trainingCategory::where(['status'=>1])->orderBy('order','ASC')->get();
	}


	public function getTrainingCategoriesBySlug($slug){
		return $this->trainingCategory::where(['slug'=>$slug])->first();
	}


	public function publishedTrainingCategoriesBySlug($slug,$id){
		return $this->trainingCategory::where(['slug'=>$slug,'id'=>$id])->first();
	}
	
}
