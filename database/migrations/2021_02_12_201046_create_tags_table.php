<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            //slug URLで使用する英数字
            //char 指定した文字数になるように右側が埋められる
            $table->id();
            $table->char('slug',50)->unique;
            $table->char('name',50);
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('post_id')->constrained();
            $table->foreignId('tag_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
}
