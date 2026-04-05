<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\Program as ProgramEnum;
use App\Models\Frontend\Program;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            ProgramEnum::ECD,
            ProgramEnum::PRIMARY_EDUCATION,
            ProgramEnum::BASIC_EDUCATION,
            ProgramEnum::SECONDARY_EDUCATION,
        ];

        // Clear existing page data
        Program::truncate();

        foreach ($programs as $index => $programEnum) {
            Program::updateOrCreate(
                [
                    'title' => $programEnum->title(),
                    'slug' => $programEnum->slug(),
                    'quota' => 'Available seats for' . $programEnum->title(),
                    'duration' => 'Duration for ' . $programEnum->title(),
                    'eligibility' => 'Eligibility criteria for ' . $programEnum->title(),
                    'description' => 'Description for ' . $programEnum->title(),
                    'order' => $index + 1,
                    'status' => true,
                ],
            );
        }
    }
}
