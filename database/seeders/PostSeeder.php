<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::select('id')->pluck('id')->toArray();
        foreach($users as $user){
            for($i=0;$i < 3; $i++){
                Post::create([
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'contact_phone_number' => $faker->phoneNumber,
                    'user_id' => $user,
                ]);
            }
        }
    }
}
