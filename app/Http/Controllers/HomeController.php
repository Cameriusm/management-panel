<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role_id = Auth::user()->roles()->first()->pivot->role_id;
        if ($role_id != 1 && $role_id != 2) {
            return redirect('panel/');
            // return view('home');
        } else if ($role_id == 1) {
            return view('home');
        } else {
            return redirect()->route('reports.create');
        }
    }
}
