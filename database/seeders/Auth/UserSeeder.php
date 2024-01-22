<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $user1 = new User();
        $user1->name = 'Gulácsi András';
        $user1->email = 'gulandras90@gmail.com';
        $user1->password = bcrypt('xdsehh5se4ghseh');
        $user1->save();
        $user1->refresh();

        $user2 = new User();
        $user2->name = 'John Doe';
        $user2->email = 'john@doe.com';
        $user2->password = bcrypt('password');
        $user2->save();
    }
}
