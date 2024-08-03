<?php

namespace App\Managers\Frontend;

use App\Constants\CommonConstants;
use App\Constants\PostConstants;
use App\Models\Frontend\Post;

use DB;

class PostManager
{
	protected $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function all($params = null, $perPage)
	{

		$query = $this->post::select('*');

		if ($params['title']) {
			$query = $query->where('title', 'like', '%' . $params['title'] . '%');
		}

		if ($params['academic_year_id']) {
			$query = $query->where(['academic_year_id' => $params['academic_year_id']]);
		}

		if ($params['post_category_id']) {
			$query = $query->where(['post_category_id' => $params['post_category_id']]);
		}

		if ($params['status'] !== null) {
			$query = $query->where(['status' => $params['status']]);
		}

		if ($params['show_on_modal'] !== null) {
			$query = $query->where(['show_on_modal' => $params['show_on_modal']]);
		}

		return  $posts = $query->orderBy('date', 'DESC')->paginate($perPage);
	}

	public function count($params = null, $academic_year_id = null, $post_category_id = null, $status = null)
	{
		$query = $this->post;

		if ($academic_year_id) {
			$query = $query->where(['academic_year_id' => $academic_year_id]);
		}

		if ($post_category_id) {
			$query = $query->where(['post_category_id' => $post_category_id]);
		}

		if ($status) {
			$query = $query->where(['status' => $status]);
		}


		return  $query->count();
	}

	public function publishedPosts($academic_year_id = null, $post_category_id = null)
	{
		$query = $this->post::where(['status' => 1])->orderBy('created_at', 'DESC');

		if ($academic_year_id) {
			$query = $query->where(['academic_year_id' => $academic_year_id]);
		}

		if ($post_category_id) {
			$query = $query->where(['post_category_id' => $post_category_id]);
		}

		return $query->get();
	}

	public function topPublishedPosts($academic_year_id = null, $post_category_id = null, $limit = null)
	{
		$query = $this->post::where(['status' => 1])->orderBy('created_at', 'DESC');

		if ($academic_year_id) {
			$query = $query->where(['academic_year_id' => $academic_year_id]);
		}

		if ($post_category_id) {
			$query = $query->where(['post_category_id' => $post_category_id]);
		}

		if ($limit) {
			$query->limit($limit);
		}
		return $query->get();
	}

	public function find($id)
	{
		return $this->post::find($id);
	}


	public function getPostBySlug($slug)
	{
		return $this->post::where(['slug' => $slug])->first();
	}


	public function publishedPostBySlug($slug, $id)
	{
		return $this->post::where(['slug' => $slug, 'id' => $id])->first();
	}


	public function modalImages($academic_year_id = null, $limit = null)
	{

		$query = $this->post::where(['status' => CommonConstants::STATUS_1, 'show_on_modal' => CommonConstants::STATUS_1]);

		$query->where('image', '!=', NULL)->orderBy('updated_at', 'DESC');

		if ($academic_year_id) {
			$query = $query->where(['academic_year_id' => $academic_year_id]);
		}

		if ($limit) {
			$query->limit($limit);
		}
		return $query->first();
	}
}
