<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\LocalLevelType;

class LocalLevelTypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$ll_types = [
			[
				'type_name' => 'Metropolitan',
				'type_name_short' => 'Metropolitan',
				'slug' => Str::slug('metropolitan'),
				'order' => 1

			],
			[
				'type_name' => 'Sub-metropolitan',
				'type_name_short' => 'Sub-metropolitan',
				'slug' => Str::slug('sub-metropolitan'),
				'order' => 2

			],
			[
				'type_name' => 'Municipality',
				'type_name_short' => 'Mun',
				'slug' => Str::slug('municipality'),
				'order' => 3
			],
			[
				'type_name' => 'Rural Municipality',
				'type_name_short' => 'R.M.',
				'slug' => Str::slug('rural-municipality'),
				'order' => 4
			]
		];

		LocalLevelType::truncate();
		foreach ($ll_types as $ll_type) {
			LocalLevelType::create($ll_type);
		}
	}
}
