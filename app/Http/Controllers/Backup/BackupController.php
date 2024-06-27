<?php

namespace App\Http\Controllers\Backup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{

	public function index()
	{
		$databaseName = 'gardesystem';
		$userName = 'root';
		$password ='';
		try {
			\Spatie\DbDumper\Databases\MySql::create()
			->setDbName($databaseName)
			->setUserName($userName)
			->setPassword($password)
			->dumpToFile('dump.sql');

		} catch (Exception $e) {
			dd($e->getMessage());
		}
	}

	public function databaseBackup(){

	}
}
