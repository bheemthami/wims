<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TrainingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'title' => 'Short Course Level 1',
                'order' => 1,
                'slug' => Str::slug('Short Course Level 1'),
                'status' => 1
            ],
            [
                'title' => 'Short Course Level 2',
                'order' => 2,
                'slug' => Str::slug('Short Course Level 2'),
                'status' => 1
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('training_types')->truncate();
        foreach ($types as $type) {
            DB::table('training_types')->insert($type);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
