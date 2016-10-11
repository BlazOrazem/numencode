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
            $table->integer('ord')->default(0);
            $table->boolean('is_hidden')->default(0);
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
