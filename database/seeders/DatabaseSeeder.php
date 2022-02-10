<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('reports')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('roles')->delete();
        DB::table('users')->delete();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ModelHasRoleSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
