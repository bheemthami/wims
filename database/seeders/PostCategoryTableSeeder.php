<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostCategoryTableSeeder extends Seeder
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
                'title' => 'Notices',
                'order' => 1,
                'slug' => Str::slug('notices'),
                'status' => 1
            ],
            [
                'title' => 'News',
                'order' => 2,
                'slug' => Str::slug('news'),
                'status' => 1
            ],
            [
                'title' => 'Results',
                'order' => 3,
                'slug' => Str::slug('results'),
                'status' => 1
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('post_categories')->truncate();
        foreach ($categories as $category) {
            DB::table('post_categories')->insert($category);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
