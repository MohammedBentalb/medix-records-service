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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('prescription_id');
            $table->string('medicine_name', 255);
            $table->string('dosage', 100);
            $table->string('frequency', 100);
            $table->smallInteger('duration');
            $table->string('route', 20)->default('oral');
            $table->text('instructions');
            $table->timestamps();

            $table->foreign('prescription_id')->references('id')->on('prescriptions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
