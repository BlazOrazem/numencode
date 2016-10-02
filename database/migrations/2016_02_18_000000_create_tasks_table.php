<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });

        Schema::create('tasks_i18n', function(Blueprint $table)
        {
            $table->integer('task_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title');
            $table->text('body');

            $table->primary(['task_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
        Schema::drop('tasks_i18n');
    }
}
