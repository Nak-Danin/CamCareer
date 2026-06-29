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
        Schema::create('careers', function (Blueprint $table) {
            $table->smallIncrements('career_id');
            $table->foreignId('company_id')->constrained(table: 'companies', column: 'company_id')->onDelete('cascade');
            $table->string('title', 150);
            $table->string('slug')->unique();
            $table->string('salary_range')->default('Negotiable');
            $table->string('description');
            $table->json('responsibilities');
            $table->json('requirements');
            $table->json('benefits');
            $table->string('location');
            $table->enum('career_type', ['full-time', 'part-time', 'internship', 'contract']);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
