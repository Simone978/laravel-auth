<?php

use Illuminate\Database\Seeder;
use App\Comment;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $newcomment= new Comment;
            $comment = Comment::all();
            $count = count($comment);
            $newcomment->post_id = rand(1,$count);
            $newcomment->name = $faker->sentence(2);
            $newcomment->body= $faker->text(255);
            $newcomment->save();
        }
    }
}
