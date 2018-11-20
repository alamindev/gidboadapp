<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('power_id');
            $table->string('logo')->default('photo');
            $table->string('lat');
            $table->string('lng');
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            $table->string('phone')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->text('info');
            $table->foreign('power_id')->references('id')->on('power_plants')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('power_infos');
    }
}
