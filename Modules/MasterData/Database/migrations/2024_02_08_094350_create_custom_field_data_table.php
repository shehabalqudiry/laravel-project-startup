<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_field_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('custom_field_id'); 
            $table->foreign('custom_field_id')->references('id')->on('custom_fields');
            $table->index('value');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_field_data');
    }
};
