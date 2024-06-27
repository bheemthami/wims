<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Gallery;

use DB;

class GalleryManager
{
	protected $gallery;

	public function __construct(Gallery $gallery)
	{
		$this->gallery = $gallery;
	}

	public function all($params = null,$perPage,$status = null){
		$query = $this->gallery::with(['images'=>function($query){
			$query->orderBy('order','ASC');
		}])->select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($params['academic_year_id']) {
			$query->where('academic_year_id','=', $params['academic_year_id']);
		}

		if ($params['type']) {
			$query->where('type','=', $params['type']);
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->orderBy('date','ASC')->paginate($perPage);
	}

	public function count($academic_year_id = null,$type = null,$status = null){
		$query = $this->gallery;

		if ($academic_year_id) {
			$query->where('academic_year_id','=', $academic_year_id);
		}

		if ($type) {
			$query->where('type','=', $type);
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->gallery::find($id);
	}

	public function publishedGallery($params = null,$perPage,$status = 1,$limit =null)
	{
		$query = $this->gallery::with(['images'=>function($query){
			$query->orderBy('order','ASC');
		}])->select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($params['academic_year_id']) {
			$query->where('academic_year_id','=', $params['academic_year_id']);
		}

		if ($params['type']) {
			$query->where('type','=', $params['type']);
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		if ($limit) {
			$query->limit($limit);
		}

		return $query->orderBy('date','ASC')->paginate($perPage);
	}

	public function publishedGalleryBySlug($slug)
	{
		$query = $this->gallery::with(['images'=>function($query){
			$query->orderBy('order','ASC');
		}])->select('*');

		if ($slug) {
			$query->where('slug','=', $slug);
		}

		return $query->first();
	}


	public function topOneVideo()
	{
		$query = $this->gallery::where(['type'=>'video'])->orderBy('date','DESC');

		return $query->first();
	}

}
