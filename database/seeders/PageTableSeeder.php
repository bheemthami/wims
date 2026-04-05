<?php

namespace Database\Seeders;

use App\Enums\Page as PageEnum;
use App\Models\Frontend\Page;
use Illuminate\Database\Seeder;
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
            PageEnum::ABOUT,
            PageEnum::INTRODUCTION,
            PageEnum::MISSION_VISION_GOAL_AND_OBJECTIVES,
            PageEnum::STUDENT_CLUBS,
            PageEnum::SMC,
            PageEnum::PTA,
            PageEnum::CONTACT_US,
        ];

        // Clear existing page data
        Page::truncate();

        foreach ($pages as $index => $pageEnum) {
            Page::updateOrCreate(
                ['slug' => $pageEnum->value], // unique key
                [
                    'title' => $pageEnum->title(),
                    'summary' => 'Default summary for ' . $pageEnum->title(),
                    'description' => 'Default description for ' . $pageEnum->title(),
                    'order' => $index + 1,
                    'status' => true,
                ]
            );
        }
    }
}
