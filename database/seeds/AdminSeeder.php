<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role'      => 'Admin',
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'no_hp'     => '081214366125',
            'password'  => Hash::make('12345678')
        ]);
    }
}
