<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;

class ModuleController extends Controller
{
    public function index()
    {

        try {
            if(Sentinel::hasAccess('modules.index')){
                $modules = sidebarlist();
                
                return view('admin.modules.index',compact('modules'));
            }
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('modules.index')->with('error','Oops! Something went wrong.');
        }
    }
}
