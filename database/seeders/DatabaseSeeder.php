<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        //postsTableに作成したいデータの数を指定する
        \App\Models\Post::factory(50)->create();
        $this->call(UserSeeder::class);

    }
}
