<?php

namespace App\Exports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class SchoolExport implements FromCollection,WithHeadings
{

	public function collection()
	{

		$schools  = School::join('school_categories','schools.school_category_id','=','school_categories.id')->join('wards','schools.ward_id','=','wards.id')->selectRaw("CONCAT_WS(' ',schools.name,'',school_categories.level) AS school_name,schools.address,schools.principal,schools.principal_contact,schools.phone,schools.email")->orderBy('wards.ward_no')->get();
		return $schools;
	}

	public function headings(): array
	{

		$header = [
			'School Name',
			'School Address',
			'Principal',
			'Principal Contact',
			'Phone',
			'Email'
		];

		return $header;
	}
}
