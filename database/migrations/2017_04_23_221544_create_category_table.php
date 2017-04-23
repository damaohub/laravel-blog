<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_category', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('cate_id');
            $table->string('cate_name',55)->default('')->comment('//分类名');
            $table->string('cate_title',50)->default('')->comment('//分类说明');
            $table->string('cate_keywords')->default('')->comment('//分类关键字');
            $table->string('cate_description')->default('')->comment('//描述');
            $table->integer('cate_view')->default('')->comment('//浏览次数');
            $table->integer('cate_order')->default(0)->comment('//排序');
            $table->integer('cate_pid')->comment('//父类');

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
