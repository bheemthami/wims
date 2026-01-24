<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TrainingCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Electrical',
                'order' => 1,
                'slug' => Str::slug('electrical'),
                'status' => 1
            ],
            [
                'title' => 'Mechanical',
                'order' => 2,
                'slug' => Str::slug('mechanical'),
                'status' => 1
            ],
            [
                'title' => 'Sanitation',
                'order' => 3,
                'slug' => Str::slug('sanitation'),
                'status' => 1
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('training_categories')->truncate();
        foreach ($categories as $category) {
            DB::table('training_categories')->insert($category);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
