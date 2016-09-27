<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->string('title');
            $table->text('body')->nullable();
            $table->integer('ord')->default(0);
            $table->boolean('is_hidden')->default(0);
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('controller');
            $table->string('method');
        });

        Schema::create('page_content', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
            $table->integer('content_id')->unsigned();
            $table->string('params')->nullable();
            $table->integer('ord')->default(0);
            $table->boolean('is_hidden')->default(0);

            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');

            $table->foreign('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('cascade');

            $table->primary(['page_id', 'content_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
        Schema::drop('contents');
        Schema::drop('page_content');
    }
}
