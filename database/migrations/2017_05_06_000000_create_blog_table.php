<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('blog_category', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
		});

        Schema::create('blog_category_i18n', function(Blueprint $table)
        {
            $table->integer('blog_category_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title')->nullable();
            $table->text('lead')->nullable();
            $table->text('body')->nullable();

            $table->primary(['blog_category_id', 'locale']);
        });

        Schema::create('blog_item', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('blog_category_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('blog_item_i18n', function(Blueprint $table)
        {
            $table->integer('blog_item_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title')->nullable();
            $table->text('lead')->nullable();
            $table->text('body')->nullable();

            $table->primary(['blog_item_id', 'locale']);
        });

        Schema::create('blog_item_comment', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('blog_item_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('locale', 6);
            $table->boolean('is_published')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('blog_category');
        Schema::dropIfExists('blog_category_i18n');
        Schema::dropIfExists('blog_item');
        Schema::dropIfExists('blog_item_i18n');
        Schema::dropIfExists('blog_item_comment');
    }
}
