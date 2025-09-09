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
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')
                ->constrained('recipes')
                ->onDelete('cascade'); // si une recette est supprimée, les étapes aussi
            $table->unsignedInteger('step_number'); // ex: 1, 2, 3...
            $table->text('description'); // "Couper les oignons", etc.
            $table->text('advice')->nullable(); // "Couper les oignons", etc.
            $table->integer('duration')->nullable(); // en minutes (optionnel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_steps');
    }
};
