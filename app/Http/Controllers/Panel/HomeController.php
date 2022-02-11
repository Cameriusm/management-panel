<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller 
{
    public function index() {
        $user_role = Auth::user()->roles()->first()->pivot->role_id;
        if ($user_role == 2) {
          return redirect()->route('reports.create');
        }

        $submitted = Report::whereDate('created_at', \Carbon\Carbon::now()->toDateString())
          ->get('user_id');
        $userSubmitted = User::with(['reports'])->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereIn('id', $submitted)->get();
        $userUnsubmitted = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereNotIn('id', $submitted)->get();
            
        return view('panel.home.index',compact('userSubmitted', 'userUnsubmitted'));
        
    }
}
