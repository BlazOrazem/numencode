<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodelistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('codelist_group', function (Blueprint $table) {
			$table->increments('id');
            $table->string('title');
            $table->integer('ord')->default(0);
		});

        Schema::create('codelist_item', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('codelist_group_id')->unsigned()->index();
            $table->string('code');
            $table->string('title');
            $table->integer('ord')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codelist_group');
        Schema::dropIfExists('codelist_item');
    }
}
