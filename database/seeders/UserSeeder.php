<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {

        $users = [
            ['id' => 1, 'name' => 'Smith', 'email' => 'smith@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 2, 'name' => 'Mate', 'email' => 'matt@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 3, 'name' => 'Nate', 'email' => 'nate@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 4, 'name' => 'Michael', 'email' => 'michael@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 5, 'name' => 'Lane', 'email' => 'lane@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 6, 'name' => 'Tommy', 'email' => 'tommy@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 7, 'name' => 'Ashley', 'email' => 'ashley@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 8, 'name' => 'Brian', 'email' => 'brian@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 9, 'name' => 'Susan', 'email' => 'susan@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 10, 'name' => 'Simon', 'email' => 'simon@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 11, 'name' => 'Harry', 'email' => 'harry@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 12, 'name' => 'Olatunji', 'email' => 'olatunji@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 13, 'name' => 'Josh', 'email' => 'josh@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 14, 'name' => 'Randolph', 'email' => 'randolph@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
            ['id' => 15, 'name' => 'Vikk', 'email' => 'vikk@gmail.com', 'verified' => '2020-01-01 03:14:07','password' => bcrypt('12345678')],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
