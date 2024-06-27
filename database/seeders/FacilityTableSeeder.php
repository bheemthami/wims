<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $facilities = [
            [
                'title' => 'Physics Lab',
                'slug'  => 'physics-lab',
                'order' => 1,
                'description' => '...please update',
                'status'=> 1
            ],[
                'title' => 'Computer Lab',
                'slug'  => 'computer-lab',
                'order' => 2,
                'description' => '...please update',
                'status'=> 1
            ],[
                'title' => 'Modern Library',
                'slug'  => 'modern-library',
                'order' => 3,
                'description' => '...please update',
                'status'=> 1
            ]

        ];

        DB::table('facilities')->truncate();

        foreach ($facilities as $facility) {
            DB::table('facilities')->insert($facility);
        }

    }
}
