<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModelHasRole;
use Auth;
class RightController extends Controller
{

        public function __construct()
    {
            $this->middleware(['role:manager|admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $ModelHasRoles = new ModelHasRoles;
        $rights = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->orderBy('id', 'desc')->get();
        // return view($rights);
        return view('panel.home.rights', [
            'rights' => $rights,
            // 'ModelHasRoles' => $ModelHasRoles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rights = User::find($id);
        $rights->role_id = $rights->roles->pluck('id');
        return response()->json($rights);
    //   $test = Test::whereSlug($slug)->firstOrFail();
    //   return view('panel.home.show', compact('test'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $product = Product::find($product_id);
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->save();
        // return response()->json($product);
        // \Log::info($id);
        $role = ModelHasRole::where('model_id', $id)->first(); 
        $role->role_id = $request->role_id;
        // return $role;
        // $role->id = $request->id;
        $role->save();
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
