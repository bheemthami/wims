<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
    	$this->call(UsersTableSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(TrainingCategoryTableSeeder::class);
        $this->call(TrainingTypeTableSeeder::class);
        $this->call(ProgramTableSeeder::class);
        $this->call(FacilityTableSeeder::class);
        $this->call(LocalLevelTypeSeeder::class);
    }
}
