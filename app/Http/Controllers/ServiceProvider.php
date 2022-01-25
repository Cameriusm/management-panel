<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceProvider extends Controller
{
    //

    public static function getUserRoleByReportId($id){
        return ModelHasRole::where('model_id', $id)->value('role_id');
    }
}
