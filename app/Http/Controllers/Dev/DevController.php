<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevController extends Controller
{
	public function migrate()
	{
		try {
			\Artisan::call('migrate');
			return "Successfull run latest Migration";
		} catch (\Exception $e) {
			dd("Migration Unsuccessfull", $e->getMessage());
		}
	}

	public function clear()
	{
		try {
			\Artisan::call('cache:clear');
			\Artisan::call('view:clear');
			\Artisan::call('route:clear');
			\Artisan::call('cache:clear');
			\Artisan::call('clear-compiled');
			\Artisan::call('config:cache');
			return "Successfull Cleared!";
		} catch (\Exception $e) {
			dd("Clear Unsuccessfull", $e->getMessage());
		}
	}

	public function seed()
	{
		try {
			\Artisan::call('db:seed');
			return "Successfull seeded!";
		} catch (\Exception $e) {
			dd("Seeded Unsuccessfull", $e->getMessage());
		}
	}
}
