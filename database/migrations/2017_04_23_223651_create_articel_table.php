<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('art_id');
            $table->string('art_title',100)->default('')->comment('//文章标题');
            $table->string('art_tag')->default('')->comment('//文章标签');
            $table->string('art_description')->default('')->comment('//文章描述');
            $table->string('art_thumb')->default('')->comment('//文章缩略图');
            $table->text('art_context')->default('')->comment('//文章内容');
            $table->integer('art_time')->default('')->comment('//文章发布时间');
            $table->string('art_editor',50)->default('')->comment('//文章作者');
            $table->integer('art_view')->default('')->comment('//浏览次数');
            $table->integer('cate_id')->comment('//分类');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
