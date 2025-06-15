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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teaching_session_id')->constrained('teaching_sessions')->onDelete('cascade');
            $table->string('payment_proof_path')->nullable(); // path to the payment proof uploaded by the student
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->dateTime('verified_at')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
