<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Document;

use DB;

class DocumentManager
{
	protected $document;

	public function __construct(Document $document)
	{
		$this->document = $document;
	}

	public function all($params,$perPage){

		$query = $this->document::select('*'); 

		if($params['title']){
			$query = $query->where('title','like','%'.$params['title'].'%');
		}

		if($params['academic_year_id']){
			$query = $query->where(['academic_year_id'=>$params['academic_year_id']]);
		}

		if($params['document_type_id']){
			$query = $query->where(['document_type_id'=>$params['document_type_id']]);
		}

		if($params['status']){
			$query = $query->where(['status'=>$params['status']]);
		}

		return $documents = $query->orderBy('order','DESC')->paginate($perPage);
	}

	public function count($academic_year_id = null,$document_type_id=null,$status=null){

		$query = $this->document::select('*'); 

		if($academic_year_id){
			$query = $query->where(['academic_year_id'=>$academic_year_id]);
		}

		if($document_type_id){
			$query = $query->where(['document_type_id'=>$document_type_id]);
		}

		if($status){
			$query = $query->where(['status'=>$status]);
		}

		return $documents = $query->count();
	}


	public function publishedDocuments($document_type_id = null,$perPage){

		$query = $this->document::select('*')->where(['status'=>1]); 

		if($document_type_id){
			$query = $query->where(['document_type_id'=>$document_type_id]);
		}

		return $documents = $query->orderBy('created_at','DESC')->paginate($perPage);
	}



	public function find($id){
		return $this->document::find($id);
	}


	public function getDocumentBySlug($slug){
		return $this->document::where(['slug'=>$slug])->first();
	}
	
}
