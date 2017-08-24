<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*\App\Model\User::truncate();*/
        \App\Model\Post::truncate();
        \App\Model\Category::truncate();
        \App\Model\Tag::truncate();
        Model::unguard();
        factory(App\Model\Category::class)->create(['name' => 'Android']);
        factory(App\Model\Category::class)->create(['name' => 'Java']);
        factory(App\Model\Category::class)->create(['name' => 'Php']);
        factory(App\Model\Category::class)->create(['name' => 'Spring']);
        factory(App\Model\Category::class)->create(['name' => 'Laravel']);
        factory(App\Model\Category::class)->create(['name' => 'Vue']);
        factory(App\Model\Category::class)->create(['name' => 'Js']);
        factory(App\Model\Tag::class, 10)->create();
        $tag_ids = \App\Model\Tag::all();
        factory(App\Model\User::class, 10)->create()->each(function ($u) use ($tag_ids) {
            factory(App\Model\Post::class, mt_rand(0, 10))->make(
                ['category_id' => mt_rand(1, 7)]
            )->each(function ($post) use ($u, $tag_ids) {
                $p = $u->posts()->save($post);
                $count = mt_rand(1, 4);
                $ids = [];
                for ($i = 0; $i < $count; $i++) {
                    array_push($ids, $tag_ids[mt_rand(1, 9)]->id);
                }
                $p->tags()->sync($ids);
            });

        });
    }
}
