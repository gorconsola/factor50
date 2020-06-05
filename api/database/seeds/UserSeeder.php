<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Cor',
            'email' => 'c.y.kroon@gmail.com',
            'user_role_id' => 1,
            'password' => Hash::make('Factor50'),
        ]);

        User::create([
            'name' => 'Dinkie',
            'email' => 'c.y.kroon+1@gmail.com',
            'user_role_id' => 2,
            'password' => Hash::make('Secret'),
        ]);
    }
}
