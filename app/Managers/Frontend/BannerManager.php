<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Banner;

use DB;
use Illuminate\Support\Str;

class BannerManager
{
	protected $banner;

	public function __construct(Banner $banner)
	{
		$this->banner = $banner;
	}

	public function all($params = null, $perPage)
	{
		$query = $this->banner::select('*');

		if ($params['title']) {
			$query->where('title', 'like', Str::lower('%' . $params['title']) . '%');
		}

		if ($params['status'] !== null) {
			$query->where(['status' => $params['status']]);
		}

		return $query->orderBy('created_at', 'ASC')->paginate($perPage);
	}

	public function count($status = null)
	{
		$query = $this->banner;

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->count();
	}


	public function find($id)
	{
		return $this->banner::find($id);
	}

	public function publishedBanners()
	{
		return $this->banner::where(['status' => 1])->orderBy('order', 'ASC')->get();
	}
}
