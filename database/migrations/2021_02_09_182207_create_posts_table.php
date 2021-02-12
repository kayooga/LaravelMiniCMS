<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            //nullable null可
            $table->text('body')->nullable();
            $table->boolean('is_public')->default(true)->comment('公開・非公開');
            //DB::raw(SQL文)直接SQL文を使う
            $table->dateTime('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('公開日');
            //user_idの追加 
            //従posts_tableで主users_tableを参照するためのキーを外部キーという
            //foreignID 外部キー
            //constrained 関連するテーブルがusersじゃない場合引数に指定する
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
