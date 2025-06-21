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
        Schema::table('teaching_sessions', function (Blueprint $table) {
            $table->renameColumn('scheduled_at', 'start_at');
        });

        Schema::table('teaching_sessions', function (Blueprint $table) {
            $table->timestamp('end_at')->after('start_at');
            $table->text('material')->nullable()->after('end_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teaching_sessions', function (Blueprint $table) {
            $table->renameColumn('start_at', 'scheduled_at');
        });

        Schema::table('teaching_sessions', function (Blueprint $table) {
            $table->dropColumn(['end_at', 'material']);
        });
    }
};
