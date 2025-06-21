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
        Schema::create('tennis_racket_variants', function (Blueprint $table) {
            $table->id();
            $table->string('article_number', 20)->unique();
            $table->string('color', 50);
            $table->integer('weight');
            $table->integer('head_size');
            $table->integer('balance');
            $table->string('string_pattern', 10);
            $table->integer('stiffness');
            $table->integer('length');
            $table->string('frame_profile', 20);
            $table->year('year')->nullable();
            $table->foreignId('tennis_racket_model_id')->constrained('tennis_racket_models')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tennis_racket_variants');
    }
};
