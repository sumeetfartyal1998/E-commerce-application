<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles=[['role_name' => "Superadmin"],['role_name' => "Admin"],['role_name' => "Inventory manager"],['role_name' => "Order manager"],['role_name' => "Customer"]];        
        // Role::create($roles);
        DB::table('roles')->insert([['role_name' => "Superadmin"],['role_name' => "Admin"],['role_name' => "Inventory manager"],['role_name' => "Order manager"],['role_name' => "Customer"]]);
    }
}
