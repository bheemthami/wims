<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'title' => 'Diploma in Civil Engineering',
                'slug'  => 'diploma-in-civil-engineering',
                'quota' => '48 seats',
                'duration' => '3 years',
                'eligibility' => 'SLC/SEC with C Grading in Science & Math, D+ Grading in English.',
                'description' => 'diploma-in-computer-engineering',
                'order' => 1,
                'status'=> 1
            ],[
                'title' => 'Diploma in Computer Engineering',
                'slug'  => 'diploma-in-computer-engineering',
                'quota' => '48 seats',
                'duration' => '3 years',
                'eligibility' => 'SLC/SEC with C Grading in Science & Math, D+ Grading in English.',
                'description' => 'diploma-in-computer-engineering',
                'order' => 2,
                'status'=> 1
            ]

        ];

        DB::table('programs')->truncate();

        foreach ($programs as $program) {
            DB::table('programs')->insert($program);
        }
    }
}
