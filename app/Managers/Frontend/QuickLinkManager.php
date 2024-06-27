<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\QuickLink;

use DB;

class QuickLinkManager
{
	protected $quickLink;

	public function __construct(QuickLink $quickLink)
	{
		$this->quickLink = $quickLink;
	}

	public function all($params = null,$perPage,$status = null){
		$query = $this->quickLink::select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->orderBy('order','ASC')->paginate($perPage);
	}

	public function count($status = null){
		$query = $this->quickLink;

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->quickLink::find($id);
	}


	public function publishedQuickLinks($params=null){
		$query = $this->quickLink::where(['status'=>1]);
		
		if ($params) {
			$query->whereIn('type', array_values($params));
		}

		return $query->orderBy('order','ASC')->get();
	}

}
