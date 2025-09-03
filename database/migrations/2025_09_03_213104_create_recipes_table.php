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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // lien vers users
            $table->string('title'); // titre
            $table->text('description')->nullable(); // description
            $table->enum('type', ['entrée', 'plat', 'dessert'])->default('plat'); // type
            $table->integer('preparation_time')->nullable(); // temps de préparation en minutes
            $table->enum('difficulty', ['facile', 'moyen', 'difficile'])->default('moyen'); // difficulté
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
