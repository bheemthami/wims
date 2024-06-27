<?php

namespace App\Managers\Frontend;

use App\Models\Frontend\Program;

use DB;

class ProgramManager
{
	protected $program;

	public function __construct(Program $program)
	{
		$this->program = $program;
	}

	public function all($params= null, $perPage){
		$query = $this->program::select('*'); 

		if($params['title']){
			$query = $query->where('title','like','%'.$params['title'].'%');
		}

		return  $programs = $query->orderBy('order','ASC')->paginate($perPage);

	}

	public function count($status = null){
		$query = $this->program;

		if($status){
			$query = $query->where(['status' => $status]);
		}

		return  $programs = $query->count();

	}

	public function publishedPrograms(){
		$query = $this->program::where(['status'=>1])->orderBy('order','ASC');
		
		return $query->get();
	}

	public function find($id){
		return $this->program::find($id);
	}


	public function getProgramBySlug($slug){
		return $this->program::where(['slug'=>$slug])->first();
	}
	
}
