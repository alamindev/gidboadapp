<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main_logo');
            $table->string('fav_icon');
            $table->string('distri_logo');
            $table->string('distri_text');
            $table->string('side_icon_1')->default('icon');
            $table->string('side_icon_2')->default('icon');
            $table->string('side_icon_3')->default('icon');
            $table->string('side_icon_4')->default('icon');
            $table->string('side_icon_5')->default('icon');
            $table->string('side_icon_6')->default('icon');
            $table->string('side_icon_7')->default('icon');
            $table->string('side_icon_8')->default('icon');
            $table->string('side_title_1');
            $table->string('side_title_2');
            $table->string('side_title_3');
            $table->string('side_title_4');
            $table->string('side_title_5');
            $table->string('side_title_6');
            $table->string('side_title_7');
            $table->string('side_title_8');
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
        Schema::dropIfExists('generals');
    }
}
