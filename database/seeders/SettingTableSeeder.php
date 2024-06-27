<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setting;

use DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    	DB::table('settings')->truncate();

    	$setting = Setting::create([
    		'municipality' => 'Local Level Name',
            'district_name' => 'Dolakha',
            'office'=>'Office  Name',
            'office_address' =>'Office Address',
            'province_name' =>'Province Name',
            'province_no' =>3,
            'phone' =>'office Phone No.',
            'email' => 'example@gmail.om',
            'system_name'   =>'Website Information Management System',
            'system_short_name'=>'WIMS',
            'tag_line'=> 'Move Digitally',
            'logo'=>'logo.png',
            'local_logo'=>'local_logo.png',
            'favicon'=>'favicon.png',
            'per_page' => 20,
            'academic_year_id' => 1

    	]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
