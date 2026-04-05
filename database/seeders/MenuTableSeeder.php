<?php

namespace Database\Seeders;

use App\Enums\Page;
use App\Enums\PostCategory;
use App\Models\Frontend\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Clear existing menu data
        Menu::truncate();

        // Define the menu structure
        $menus = [
            [
                'label' => 'Home',
                'url' => '/',
                'position' => 0,
            ],
            [
                'label' => Page::ABOUT->title(),
                'url' => '/' . Page::ABOUT->slug(),
                'position' => 1,
                'children' => [
                    [
                        'label' => Page::INTRODUCTION->title(),
                        'url' => '/' . Page::INTRODUCTION->slug(),
                        'position' => 9,
                    ],
                    [
                        'label' => Page::MISSION_VISION_GOAL_AND_OBJECTIVES->title(),
                        'url' => '/' . Page::MISSION_VISION_GOAL_AND_OBJECTIVES->slug(),
                        'position' => 10,
                    ],
                    [
                        'label' => Page::STUDENT_CLUBS->title(),
                        'url' => '/' . Page::STUDENT_CLUBS->slug(),
                        'position' => 11,
                    ],
                ]
            ],
            [
                'label' => 'Members',
                'url' => null,
                'position' => 2,
                'children' => [
                    [
                        'label' => 'Faculties',
                        'url' => '/faculties',
                        'position' => 13,
                    ],
                    [
                        'label' => Page::SMC->title(),
                        'url' => '/' . Page::SMC->slug(),
                        'position' => 14,
                    ],
                    [
                        'label' => Page::PTA->title(),
                        'url' => '/' . Page::PTA->slug(),
                        'position' => 15,
                    ],
                ]
            ],
            [
                'label' => 'Programs',
                'url' => '/programs',
                'position' => 3,
                'is_active' => false,
            ],
            [
                'label' => 'Facilities',
                'url' => '/facilities',
                'position' => 4,
            ],
            [
                'label' => PostCategory::NEWS_AND_EVENTS->title(),
                'url' => '/' . PostCategory::NEWS_AND_EVENTS->slug(),
                'position' => 5,
            ],
            [
                'label' => 'Resources',
                'url' => null,
                'position' => 6,
                'children' => [
                    [
                        'label' => PostCategory::NOTICE->title(),
                        'url' => '/resources/' . PostCategory::NOTICE->slug(),
                        'position' => 16,
                    ],
                    [
                        'label' => PostCategory::ANNUAL_CALENDAR->title(),
                        'url' => '/resources/' . PostCategory::ANNUAL_CALENDAR->slug(),
                        'position' => 17,
                    ],
                    [
                        'label' => PostCategory::CAREER->title(),
                        'url' => '/resources/' . PostCategory::CAREER->slug(),
                        'position' => 18,
                    ],
                    [
                        'label' => PostCategory::SMC_DECISION->title(),
                        'url' => '/resources/' . PostCategory::SMC_DECISION->slug(),
                        'position' => 19,
                    ],
                    [
                        'label' => 'Publications',
                        'url' => '/publications',
                        'position' => 19,
                    ],
                ]
            ],
            [
                'label' => 'Gallery',
                'url' => null,
                'position' => 7,
                'children' => [
                    [
                        'label' => 'Photo Gallery',
                        'url' => '/photo-gallery',
                        'position' => 20,
                    ],
                    [
                        'label' => 'Video Gallery',
                        'url' => '/video-gallery',
                        'position' => 21,
                    ],
                ]
            ],
            [
                'label' => Page::CONTACT_US->title(),
                'url' => '/' . Page::CONTACT_US->slug(),
                'position' => 8,
            ],
        ];

        // Create menu items
        foreach ($menus as $menu) {
            $this->createMenu($menu);
        }
    }

    private function createMenu(array $data, $parentId = null)
    {
        // Create the menu item
        $menu = Menu::create([
            'label' => $data['label'],
            'url' => $data['url'] ?? null,
            'position' => $data['position'] ?? 0,
            'icon' => $data['icon'] ?? null,
            'parent_id' => $parentId,
            'is_active' => $data['is_active'] ?? 1,
        ]);

        // If there are children, create them recursively
        if (isset($data['children'])) {
            foreach ($data['children'] as $child) {
                $this->createMenu($child, $menu->id);
            }
        }
    }
}
