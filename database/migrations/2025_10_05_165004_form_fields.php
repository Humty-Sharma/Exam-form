<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Form Fields
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_form_id')->constrained()->cascadeOnDelete();
            $table->string('field_key'); // internal key
            $table->string('label'); // label shown to user
            $table->string('type'); // text/select/file/date etc.
            $table->json('validation_rules')->nullable();
            $table->json('options')->nullable(); // for select fields
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};