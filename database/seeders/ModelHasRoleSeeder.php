<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelHasRole;
use DB;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $model_has_roles = [
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '1'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '2'],
            ['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => '3'],
            ['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => '4'],
            ['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => '5'],
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => '6'],
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => '7'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '8'],
            ['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => '9'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '10'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '11'],
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => '12'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '13'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '14'],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '15'],
        ];

        foreach($model_has_roles as $model_has_role){
            ModelHasRole::create($model_has_role);
        }
    }
}
