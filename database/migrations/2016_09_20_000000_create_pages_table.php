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
            $table->integer('route_id')->nullable()->index();
            $table->string('menu')->nullable()->default('main');
            $table->string('layout')->nullable()->default('default');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->nullable()->default(NULL);
            $table->timestamps();
        });

        Schema::create('pages_i18n', function(Blueprint $table)
        {
            $table->integer('page_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title');
            $table->text('lead')->nullable();
            $table->text('body')->nullable();

            $table->primary(['page_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('pages_i18n');
    }
}
