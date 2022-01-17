<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fname' => "Admin",
            'lname' => "admin",
            'email' => "sumeet.fartyal@neosoftmail.com",
            'password' => Hash::make('admin123'),
            'status' => 1,
            'role' => "Superadmin"
        ]);
    }
}
