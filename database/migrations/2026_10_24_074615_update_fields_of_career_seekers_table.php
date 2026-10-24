<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\NearMissValueResolverException;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('career_seekers', function (Blueprint $table) {
            $table->string('title', 150)->nullable();
            $table->string('location')->nullable();
            $table->dropColumn('resume_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_seekers', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'location',
            ]);
            $table->string('resume_url')->nullable();
        });
    }
};
