<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('racket_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tennis_racket_variant_id')->constrained('tennis_racket_variants')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('reviewers')->onDelete('set null');
            $table->string('review_url')->nullable();
            $table->unsignedTinyInteger('Groundstrokes')->nullable();
            $table->unsignedTinyInteger('Volleys')->nullable();
            $table->unsignedTinyInteger('Serves')->nullable();
            $table->unsignedTinyInteger('Returns')->nullable();
            $table->unsignedTinyInteger('Power')->nullable();
            $table->unsignedTinyInteger('Control')->nullable();
            $table->unsignedTinyInteger('Maneuverability')->nullable();
            $table->unsignedTinyInteger('Stability')->nullable();
            $table->unsignedTinyInteger('Comfort')->nullable();
            $table->unsignedTinyInteger('TouchFeel')->nullable();
            $table->unsignedTinyInteger('Spin')->nullable();
            $table->unsignedTinyInteger('Slice')->nullable();
            $table->unsignedTinyInteger('Sexiness')->nullable();
            $table->unsignedTinyInteger('Forgiveness')->nullable();
            $table->unsignedTinyInteger('overall')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('racket_reviews');
    }
};
