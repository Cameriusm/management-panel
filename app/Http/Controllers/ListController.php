<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\ModelHasRole;
use Auth;
use Illuminate\Support\Facades\DB;
class ListController extends Controller
{
    public function index(Request $request, $user_id)
    {
        $users = User::find($user_id);
        $reports = Report::orderBy('id','desc')->where('user_id', $user_id)->get();
        return view('panel.home.list', compact('users','reports'));
    }

}
