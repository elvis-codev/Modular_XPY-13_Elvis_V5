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
        Schema::table('course_module_lessons', function (Blueprint $table) {
            // Only add embed_url since video_source already exists
            $table->text('embed_url')->nullable()->after('video_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_module_lessons', function (Blueprint $table) {
            $table->dropColumn(['embed_url']);
        });
    }
};