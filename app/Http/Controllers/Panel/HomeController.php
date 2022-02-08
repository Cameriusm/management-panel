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
      $currentUser = Auth::user()->roles()->first();
      $user = User::with(['reports'])->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
      ->find(Auth::user()->id);
      // return $user->reports;
      if ($currentUser->pivot->role_id == 2) {
        return view('panel.home.worker',compact('user'));
      }

        $submitted = Report::whereDate('created_at', \Carbon\Carbon::now()->timezone('Asia/Krasnoyarsk')->toDateString())
          ->get('user_id');
        $userSubmitted = User::with(['reports'])->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereIn('id', $submitted)->get();
        $userUnsubmitted = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereNotIn('id', $submitted)->get();
            
        return view('panel.home.index',compact('userSubmitted', 'userUnsubmitted'));
       
    }


  /**    
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id) {
        $unsubmitted = Report::whereDate('created_at', '!=' ,'2022-01-25')
          ->get('id');
        $submitted = Report::whereDate('created_at', '2022-01-25')
          ->get('id');
        $userSubmitted = DB::table('users')
                    ->whereIn('id', $submitted)
                    ->get();
        $userUnsubmitted = DB::table('users')
                    ->whereIn('id', $unsubmitted)
                    ->get();
        return view('panel.home.index',compact('userSubmitted', 'userUnsubmitted'));
       
    }
}
