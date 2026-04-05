<?php

namespace Database\Seeders;

use App\Enums\PostCategory as PostCategoryEnum;
use App\Models\Frontend\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            PostCategoryEnum::NEWS_AND_EVENTS,
            PostCategoryEnum::NOTICE,
            PostCategoryEnum::RESULT,
            PostCategoryEnum::CAREER,
            PostCategoryEnum::ANNUAL_CALENDAR,
            PostCategoryEnum::SMC_DECISION,
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing page data
        PostCategory::truncate();

        foreach ($categories as $index => $categoryEnum) {
            PostCategory::updateOrCreate(
                [
                    'title' => $categoryEnum->title(),
                    'slug' => $categoryEnum->slug(),
                    'order' => $index + 1,
                    'status' => true,
                ],
            );
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
