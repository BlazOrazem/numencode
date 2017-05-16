<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('promotion_category', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
		});

        Schema::create('promotion_category_i18n', function(Blueprint $table)
        {
            $table->integer('promotion_category_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title')->nullable();
            $table->text('lead')->nullable();
            $table->text('body')->nullable();

            $table->primary(['promotion_category_id', 'locale']);
        });

        Schema::create('promotion_item', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('promotion_category_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('promotion_item_i18n', function(Blueprint $table)
        {
            $table->integer('promotion_item_id')->unsigned();
            $table->string('locale', 6);
            $table->string('title')->nullable();
            $table->text('lead')->nullable();
            $table->text('body')->nullable();
            $table->string('link')->nullable();

            $table->primary(['promotion_item_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_category');
        Schema::dropIfExists('promotion_category_i18n');
        Schema::dropIfExists('promotion_item');
        Schema::dropIfExists('promotion_item_i18n');
    }
}
