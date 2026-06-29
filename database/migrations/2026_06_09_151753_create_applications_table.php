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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained(table: 'careers', column: 'career_id')->onDelete('cascade');
            $table->foreignId('seeker_id')->constrained(table: 'career_seekers', column: 'seeker_id')->onDelete('cascade');
            $table->enum('status', ['applied', 'shortlisted', 'interview', 'offered', 'rejected'])->default('applied');
            $table->timestamps();
            $table->unique(['career_id', 'seeker_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
