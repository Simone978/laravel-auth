<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $newpost = new Post();
            $newpost->user_id = 1;
            $newpost->title=$faker->sentence(3);
            $newpost->body=$faker->text(255);
            $newpost->slug= Str::finish(Str::slug($newpost->title), rand(1, 1000000));
            $newpost->save();
        }

    }
}