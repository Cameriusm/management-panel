<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Traits\HasRoles;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // if ( $user->isAdmin() ) {// do your magic here
        //     return redirect()->route('dashboard');
        // }
        protected function authenticated(Request $request, $user)
        {
            $role_id = Auth::user()->roles()->first()->pivot->role_id;
            if ( $role_id != 1 && $role_id == 2 ) {
                return redirect()->route('reports.create');
            } else if($role_id == 1){
                return redirect('/');
            }
            return redirect('/panel');

        }
        protected $redirectTo = RouteServiceProvider::HOME;
        
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
        $this->middleware('guest')->except('logout');
    }
}
