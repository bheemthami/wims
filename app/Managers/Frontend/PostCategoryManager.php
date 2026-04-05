<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\PostCategory;

use DB;

class PostCategoryManager
{
	protected $postCategory;

	public function __construct(PostCategory $postCategory)
	{
		$this->postCategory = $postCategory;
	}

	public function all($params = null, $perPage, $status = null)
	{
		$query = $this->postCategory::select('*');

		if ($params['title']) {
			$query->where('title', 'like', $params['title'] . '%');
		}

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->orderBy('order', 'ASC')->paginate($perPage);
	}


	public function count($status = null)
	{
		$query = $this->postCategory;

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->count();
	}


	public function filter($status = null)
	{
		$query = $this->postCategory::select('*');

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->orderBy('order', 'ASC')->get();
	}


	public function find($id)
	{
		return $this->postCategory::find($id);
	}


	public function dropdown()
	{
		return [null => '--select--'] + $this->postCategory::orderBy('order', 'ASC')->pluck('title', 'id')->toArray();
	}


	public function publishedPostCategorys()
	{
		return $this->postCategory::where(['status' => 1])->orderBy('created_at', 'ASC')->get();
	}


	public function getPostCategorysBySlug($slug)
	{
		return $this->postCategory::where(['slug' => $slug])->first();
	}


	public function publishedPostCategorysBySlug($slug, $id)
	{
		return $this->postCategory::where(['slug' => $slug, 'id' => $id])->first();
	}
}
