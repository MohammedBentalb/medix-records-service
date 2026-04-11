<?php

use App\MaladySeverityEnum;
use App\MaladyTypeEnum;
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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('visit_id');
            $table->string('name', 255);
            $table->enum('type',  array_column(MaladyTypeEnum::cases(), 'value'));
            $table->enum('severity', array_column(MaladySeverityEnum::cases(), 'value'));
            $table->text('notes');
            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('diagnoses');
    }
};
