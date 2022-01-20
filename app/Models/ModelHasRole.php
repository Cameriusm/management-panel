<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;

    public static function getUserRoleByReportId($id){
        return ModelHasRole::where('model_id', $id)->value('role_id');
        // <th>{{ModelHasRoles:model_has_roles:->where('model_id', $right->id)->value('role_id')}}</th>
        // <th>{{ModelHasRoles:model_has_roles:->where('model_id', $right->id)->value('role_id')}}</th>
    }
}
