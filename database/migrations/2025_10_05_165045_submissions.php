<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Submissions
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('exam_form_id')->constrained()->cascadeOnDelete();
            $table->json('data')->nullable(); // form answers
            $table->enum('status', ['draft','pending_payment','paid','cancelled'])->default('draft');
            $table->decimal('amount_due', 10, 2)->default(0);
            $table->string('currency', 10)->default('INR');
            $table->string('reference_id')->nullable(); // internal reference
            $table->string('payment_method')->nullable();
            $table->string('pdf_path')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
            $table->boolean('created_by_admin')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};