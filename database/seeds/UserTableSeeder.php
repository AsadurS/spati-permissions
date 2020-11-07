<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            "name"     => "Mr. Asadur",
            "password" => "123",
            "email"    => "asad@gmial.com",
            "type"     => User::TYPE_ADMIN,
            "status"   => User::STATUS_ACTIVE,
        ]);


        $admin = User::create([
            "name"     => "safia",
            "password" => "123",
            "email"    => "safia@gmail.com",
            "type"     => User::TYPE_ADMIN,
            "status"   => User::STATUS_ACTIVE,
        ]);


        $user = User::create([
            "name"     => "Mr. Client",
            "password" => "123",
            "email"    => "user@tontri.com",
            "type"     => User::TYPE_USER,
            "status"   => User::STATUS_ACTIVE,
        ]);
        $user->assignRole(User::ROLE_USER);
        $admin->assignRole(User::ROLE_ADMIN);
        $superadmin->assignRole(User::ROLE_SUPER_ADMIN);
    }
}
