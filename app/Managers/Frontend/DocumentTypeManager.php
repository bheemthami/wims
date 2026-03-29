<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\DocumentType;

class DocumentTypeManager
{
	protected $documentType;

	public function __construct(DocumentType $documentType)
	{
		$this->documentType = $documentType;
	}

	public function all($params = null, $perPage, $status = null)
	{
		$query = $this->documentType::select('*');

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
		$query = $this->documentType::select('*');

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->count();
	}


	public function find($id)
	{
		return $this->documentType::find($id);
	}


	public function dropdown()
	{
		return [null => '--select--'] + $this->documentType::orderBy('order', 'ASC')->pluck('title', 'id')->toArray();
	}


	public function publishedDocumentTypes()
	{
		return $this->documentType::where(['status' => 1])->orderBy('order', 'ASC')->get();
	}


	public function getDocumentTypesBySlug($slug)
	{
		return $this->documentType::where(['slug' => $slug])->first();
	}


	public function publishedDocumentTypesBySlug($slug, $id)
	{
		return $this->documentType::where(['slug' => $slug, 'id' => $id])->first();
	}
}
