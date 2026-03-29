<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug'  => Str::slug('About Us'),
                'summary' => 'summary',
                'description' => 'description',
                'order' => 1,
                'status' => 1
            ],
            [
                'title' => 'Message from Principal',
                'slug'  => Str::slug('Message from Principal'),
                'summary' => 'summary',
                'description' => 'description',
                'order' => 2,
                'status' => 1
            ],
            [
                'title' => 'School Management Committee',
                'slug'  => Str::slug('School Management Committee'),
                'summary' => 'summary',
                'description' => 'description',
                'order' => 3,
                'status' => 1
            ]

        ];

        DB::table('pages')->truncate();

        foreach ($pages as $page) {
            DB::table('pages')->insert($page);
        }
    }
}
