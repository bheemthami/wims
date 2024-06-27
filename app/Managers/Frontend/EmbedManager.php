<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Embed;

use DB;

class EmbedManager
{
	protected $embed;

	public function __construct(Embed $embed)
	{
		$this->embed = $embed;
	}

	public function all($params = null,$perPage,$status = null,$slug=null){
		$query = $this->embed::select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		if ($slug) {
			$query->where(['slug'=>$slug]);
		}

		return $query->orderBy('created_at','DESC')->paginate($perPage);
	}

	public function count($status = null){
		$query = $this->embed;

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->embed::find($id);
	}

	public function getEmbeddingByType($type){
		return $this->embed::where(['type'=>$type])->first();
	}
	
}
