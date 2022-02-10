<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            ['id' => 1, 'name' => 'guest', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'worker', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'manager', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'admin', 'guard_name' => 'web'],
        ];

        foreach($roles as $role){
            Role::create($role);
        }
    }
}
