<?php

namespace Database\Seeders;

use App\Models\User;
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
        $faker = \Faker\Factory::create();

        for($i=0;$i<100;$i++){
            User::create([
                'username' => $faker->name,
                'mobile_number' => $faker->unique()->phoneNumber,
                'email' => $faker->unique()->email,
                'password' => 123123
            ]);
        }
    }
}
