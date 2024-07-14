<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Department;

use DB;
use Illuminate\Contracts\Database\Eloquent\Builder;

class DepartmentManager
{
	protected $department;

	public function __construct(Department $department)
	{
		$this->department = $department;
	}

	public function all($params = null, $perPage, $status = null, $isTeachingOfficial = null)
	{
		$query = $this->department::select('*');

		if ($status) {
			$query->where(['status' => $status]);
		}

		$query->with(['officials' => function ($query) use ($isTeachingOfficial) {
			if ($isTeachingOfficial) {
				$query->where(['officials.is_teaching_official' => 1]);
			}
		}]);

		return $query->orderBy('order', 'ASC')->paginate($perPage);
	}

	public function count($status = null)
	{
		$query = $this->department::select('*');

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->count();
	}


	public function find($id)
	{
		return $this->department::find($id);
	}


	public function dropdown()
	{
		return [null => '--select--'] + $this->department::orderBy('order', 'ASC')->pluck('title', 'id')->toArray();
	}


	public function publishedDepartments()
	{
		return $this->department::where(['status' => 1])->orderBy('created_at', 'ASC')->get();
	}


	public function getDepartmentBySlug($slug)
	{
		return $this->department::where(['slug' => $slug])->first();
	}


	public function findBySlug($slug)
	{
		return $this->department::where(['slug' => $slug])->first();
	}
}
