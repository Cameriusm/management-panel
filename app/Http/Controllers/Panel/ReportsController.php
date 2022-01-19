<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    public function index() {
        // $users_count =  User::all()->count();
        // return view('panel.home.index',[
        //     'users_count' => $users_count 
        // ]);
        return view('panel.home.reports');
    }
}
