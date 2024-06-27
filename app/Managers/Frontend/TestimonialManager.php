<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Testimonial;

use DB;

class TestimonialManager
{
	protected $testimonial;

	public function __construct(Testimonial $testimonial)
	{
		$this->testimonial = $testimonial;
	}

	public function all($params = null,$perPage,$status = null){
		$query = $this->testimonial::select('*');

		if ($params['title']) {
			$query->where('statement_by','like', $params['title'].'%');
		}

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->orderBy('order','ASC')->paginate($perPage);
	}

	public function count($status = null){
		$query = $this->testimonial;

		if ($status) {
			$query->where(['status'=>$status]);
		}

		return $query->count();
	}


	public function find($id){
		return $this->testimonial::find($id);
	}

	public function publishedTestimonials(){
		$query = $this->testimonial::where(['status'=>1])->orderBy('order','ASC');
		return $query->get();
	}

}
