<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\Designation as DesignationEnum;
use App\Models\Designation;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            DesignationEnum::CHAIRPERSON,
            DesignationEnum::MEMBER_SECRETARY,
            DesignationEnum::MEMBER,
            DesignationEnum::TEACHER_REPRESENTATIVE,
            DesignationEnum::LOCAL_GOVERNMENT_REPRESENTATIVE,
            DesignationEnum::PRINCIPAL,
            DesignationEnum::HEAD_TEACHER,
            DesignationEnum::VICE_PRINCIPAL,
            DesignationEnum::ASSISTANT_HEAD_TEACHER,
            DesignationEnum::TEACHER,
            DesignationEnum::ACCOUNTANT,
            DesignationEnum::LIBRARIAN,
            DesignationEnum::SCHOOL_NURSE,
            DesignationEnum::SCHOOL_ASSISTANT,
            DesignationEnum::SUPPORT_STAFF,
        ];

        // Clear existing page data
        Designation::truncate();

        foreach ($designations as $index => $designationEnum) {
            Designation::updateOrCreate(
                [
                    'slug' => $designationEnum->slug(),
                    'name' => $designationEnum->title(),
                    'order' => $index + 1,
                ],
            );
        }
    }
}
