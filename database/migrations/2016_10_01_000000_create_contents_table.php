<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned()->nullable()->index();
            $table->integer('plugin_id')->unsigned()->nullable()->index();
            $table->text('plugin_params')->nullable();
            $table->string('position')->default('center');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->nullable()->default(NULL);
        });

        Schema::create('contents_i18n', function(Blueprint $table)
        {
            $table->integer('content_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title')->nullable();
            $table->text('lead')->nullable();
            $table->text('body')->nullable();

            $table->primary(['content_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
        Schema::dropIfExists('contents_i18n');
    }
}
