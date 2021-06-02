<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
                'name' => 'Personal',
                'slug' => 'personal'
        ]);
        
        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);
        
        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);

        Post::create([ 
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My Personal Post',
            'slug' => 'my-first-post',
            'excerpt' => 'A short little excerpt',
            'body' => 'Duis vulputate! Orci eius hic vitae vero malesuada dicta! Numquam similique neque! Parturient ad cupiditate, facilis nostra laboriosam? Voluptates dolores qui maxime justo eos. Litora ac minim harum do pariatur lectus optio asperiores, morbi ante dapibus id ligula odit senectus, bibendum laboris, do malesuada, blandit.'

        ]);

        Post::create([ 
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My Work Post',
            'slug' => 'my-second-post',
            'excerpt' => 'A short little excerpt',
            'body' => 'Duis vulputate! Orci eius hic vitae vero malesuada dicta! Numquam similique neque! Parturient ad cupiditate, facilis nostra laboriosam? Voluptates dolores qui maxime justo eos. Litora ac minim harum do pariatur lectus optio asperiores, morbi ante dapibus id ligula odit senectus, bibendum laboris, do malesuada, blandit.'

        ]);

        Post::create([ 
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'slug' => 'my-third-post',
            'excerpt' => 'A short little excerpt',
            'body' => 'Duis vulputate! Orci eius hic vitae vero malesuada dicta! Numquam similique neque! Parturient ad cupiditate, facilis nostra laboriosam? Voluptates dolores qui maxime justo eos. Litora ac minim harum do pariatur lectus optio asperiores, morbi ante dapibus id ligula odit senectus, bibendum laboris, do malesuada, blandit.'

        ]);
    }
}
