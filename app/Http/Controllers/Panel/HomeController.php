<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Auth;
class HomeController extends Controller
{
    public function index() {
        // $users_count =  User::all()->count();
        // return view('panel.home.index',[
        //     'users_count' => $users_count 
        // ]);
        $reportCount = Report::count();
        // return $reportCount;
        return view('panel.home.index', [
            'reportCount'=> $reportCount,
        ]);
       
    }
}
