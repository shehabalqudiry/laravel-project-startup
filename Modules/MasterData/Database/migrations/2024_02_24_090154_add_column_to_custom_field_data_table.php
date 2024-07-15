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
        Schema::table('custom_field_data', function (Blueprint $table) {
            $table->after('status', function ($table) {
                $table->unsignedBigInteger('model_id')->nullable();
                $table->string('model_name')->nullable();

            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_field_data', function (Blueprint $table) {
            $table->dropColumn('model_id');
            $table->dropColumn('model_name');
        });
    }
};
