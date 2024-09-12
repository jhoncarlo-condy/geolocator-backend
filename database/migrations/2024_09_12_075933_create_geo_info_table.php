<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string("ip");
            $table->string("hostname")->nullable();
            $table->string("city")->nullable();
            $table->string("region")->nullable();
            $table->string("country")->nullable();
            $table->string("loc")->nullable();
            $table->string("org")->nullable();
            $table->string("postal")->nullable();
            $table->string("timezone")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_info');
    }
};
