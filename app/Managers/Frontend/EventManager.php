<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Event;

use DB;

class EventManager
{
	protected $event;

	public function __construct(Event $event)
	{
		$this->event = $event;
	}

	public function all($params = null,$academic_year_id = null,$perPage,$status = null,$slug=null){
		$query = $this->event::select('*');

		if ($params['title']) {
			$query->where('title','like', $params['title'].'%');
		}

		if ($academic_year_id) {
			$query->where(['academic_year_id'=>$academic_year_id]);
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		if ($slug) {
			$query->where(['slug'=>$slug]);
		}

		return $query->orderBy('created_at','DESC')->paginate($perPage);
	}

	public function count($academic_year_id = null,$status = null){
		$query = $this->event;

		if ($academic_year_id) {
			$query->where(['academic_year_id'=>$academic_year_id]);
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->event::find($id);
	}

	public function publishedEvents(){
		return $this->event::where(['status'=>1])->orderBy('created_at','DESC')->get();
	}

	public function topPublishedEvents($limit = null){
		$query = $this->event::where(['status'=>1])->orderBy('created_at','DESC');

		if ($limit) {
			$query->limit($limit);
		}
		return $query->get();
	}


	public function getEventBySlug($slug){
		return $this->event::where(['slug'=>$slug])->first();
	}


	public function publishedEventBySlug($slug,$id){
		return $this->event::where(['slug'=>$slug,'id'=>$id])->first();
	}
	
}
