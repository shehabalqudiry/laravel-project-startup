<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('additional_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('additionalable_id')->nullable();
            $table->string('additionalable_type')->nullable();
            $table->string('key');
            $table->string('value')->nullable();
            $table->integer('is_default')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('additional_data');
    }
};
