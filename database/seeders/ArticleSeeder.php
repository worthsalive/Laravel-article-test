<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Article::truncate();
        Comment::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database (20 records):
        $tags = \App\Models\Tag::all();
        //  for ($i = 0; $i < 20; $i++) {

        //     Article::create([

        //     ])->tags()->attach($tags->random(2));
        //  }


        Article::factory(20)->create()->each(function($article) use ($tags){
            Comment::factory(rand(1,10))->create([
                'article_id' => $article->id
            ]);
            for($i=0;$i <= rand(1,4);$i++){
                $tag_list[] = $tags[$i]->name;
            }
                $article->update(['tags'=>implode(',',$tag_list)]);

        });
    }
}
