<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Post::factory(50)->create();

        //postsTableに作成したいデータの数を指定する
        //\Event::fakeFor コマンドを実行したときにイベントが発生しないようにする処理
        \Event::fakeFor(function () {
            Post::factory()->count(50)->create();
        });
        
    }
}
