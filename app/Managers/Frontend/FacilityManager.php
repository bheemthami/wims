<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Facility;

use DB;

class FacilityManager
{
	protected $facility;

	public function __construct(Facility $facility)
	{
		$this->facility = $facility;
	}

	public function all($params = null, $perPage)
	{
		$query = $this->facility::with('images')->select('*');

		if ($params['title']) {
			$query = $query->where('title', 'like', '%' . $params['title'] . '%');
		}

		return  $facilities = $query->orderBy('order', 'ASC')->paginate($perPage);
	}

	public function count($status = null)
	{
		$query = $this->facility::select('*');

		if ($status) {
			$query = $query->where(['status' => $status]);
		}

		return  $facilities = $query->count();
	}

	public function publishedFacilities()
	{
		$query = $this->facility::with('images')->where(['status' => 1])->orderBy('order', 'ASC');
		return $query->get();
	}

	public function topPublishedFacilities($limit = null)
	{
		$query = $this->facility::where(['status' => 1])->orderBy('order', 'ASC');

		if ($limit) {
			$query->limit($limit);
		}
		return $query->get();
	}

	public function find($id)
	{
		return $this->facility::find($id);
	}


	public function getFacilityBySlug($slug)
	{
		return $this->facility::where(['slug' => $slug])->first();
	}


	public function publishedFacilityBySlug($slug, $id)
	{
		return $this->facility::where(['slug' => $slug, 'id' => $id])->first();
	}
}
