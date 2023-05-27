<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'email' => 'employee@demofinf.net',
            'name' => 'employee',
            'password' => 123123,
            'phone' => 01277327535
        ]);
    }
}
