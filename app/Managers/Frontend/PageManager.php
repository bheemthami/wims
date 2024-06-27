<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Page;

use DB;

class PageManager
{
	protected $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	public function all($params,$perPage){

		$query = $this->page::select('*'); 

		if($params['title']){
			$query = $query->where('title','like','%'.$params['title'].'%');
		}

		return $pages = $query->orderBy('order','ASC')->paginate($perPage);
	}

	public function count($status = null){

		$query = $this->page; 

		if($status){
			$query = $query->where(['status' => $status]);
		}

		return $pages = $query->count();
	}


	public function dropdown(){
		return [null => '--select--'] + $this->page::orderBy('order','ASC')->pluck('name','id')->toArray();
	}

	public function find($id){
		return $this->page::with('cws')->find($id);
	}


	public function getPageBySlug($slug){
		return $this->page::where(['slug'=>$slug,'status'=>1])->first();
	}

	
}
