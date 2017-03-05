<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Administrator', 'email' => 'admin@admin.com', 'password' => bcrypt('admin')],
        ];
        foreach ($users as $user) {
            if (\App\User::where('email', '=', $user['email'])->get()->isEmpty())
                \App\User::create($user);
        }

    }
}
