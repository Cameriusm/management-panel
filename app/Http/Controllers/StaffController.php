<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\ModelHasRole;
use Auth;
use Illuminate\Support\Facades\DB;
class StaffController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['reports'])->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id');
        $users = $users->orderBy('id', 'ASC')->get();
        return view('panel.home.staff',[
            'users'=>$users,
        ]);
    }
}
