<?php

namespace Database\Seeders;

use App\Enums\Department as DepartmentEnum;
use App\Models\Frontend\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            DepartmentEnum::ACADEMIC,
            DepartmentEnum::ADMIN,
            DepartmentEnum::ACCOUNT,
            DepartmentEnum::EXAMINATION,
        ];

        // Clear existing page data
        Department::truncate();

        foreach ($departments as $index => $departmentEnum) {
            Department::updateOrCreate(
                [
                    'title' => $departmentEnum->title(),
                    'slug' => $departmentEnum->slug(),
                    'order' => $index + 1,
                    'status' => true,
                ],
            );
        }
    }
}
