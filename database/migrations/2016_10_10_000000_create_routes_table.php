<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('routes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('action');
		});

        Schema::create('routes_i18n', function(Blueprint $table)
        {
            $table->integer('route_id')->unsigned();
            $table->string('locale', 6);
            $table->string('uri')->unique();
            $table->text('params')->nullable();

            $table->primary(['route_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
        Schema::dropIfExists('routes_i18n');
    }
}
