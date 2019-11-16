<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'test';
        $user->email = 'admin@test.com';
        $user->password = Hash::make('demor00txx!');
        $user->save();
       
        $user = new User();
        $user->name = 'asesor';
        $user->email = 'tamolo@mailinator.com';
        $user->password = Hash::make('abc123');
        $user->save();
    }
}