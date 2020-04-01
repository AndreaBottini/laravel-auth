<?php

use Illuminate\Database\Seeder;
use Faker\Generator as faker;
use App\Comment;
use App\Post;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    { 
        $postCount = count(Post::all()->toArray()) - 1;
         for ($i = 0; $i < 5; $i++) {
            $newComment = new Comment;
            $newComment->name = $faker->name;
            $newComment->email = $faker->email;
            $newComment->title = $faker->sentence(3);
            $newComment->body = $faker->text(150);
            $newComment->post_id = rand(1, $postCount);
            $newComment->save();
        }
    }
}