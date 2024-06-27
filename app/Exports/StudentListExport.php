<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentListExport implements FromCollection,WithHeadings
{
	protected $school_id;
	protected $academic_year_id;

	public function __construct($school_id,$academic_year_id)
	{
		$this->school_id = $school_id;
		$this->academic_year_id = $academic_year_id;
	}

	public function collection()
	{

		$query  = Shipment::select('*');

		

		return $query->get();
	}

	public function headings(): array
	{

		$header = [
			'Full name',
			'Devnagari',
			'Address',
			'Gender',
			'DOB',
			'Father Name',
			'Mother Name'
		];

		return $header;
	}
}
