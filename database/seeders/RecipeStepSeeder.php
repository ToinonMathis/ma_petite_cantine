<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeStep;

class RecipeStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeStep::create([
            'recipe_id'   => 1, // lier à la recette n°1
            'step_number' => 1,
            'description' => 'Préchauffer le four à 180°C.',
            'advice'      => 'Vérifie que le four est bien vide avant.',
            'duration'    => 10,
        ]);

        RecipeStep::create([
            'recipe_id'   => 1,
            'step_number' => 2,
            'description' => 'Éplucher et couper les oignons.',
            'advice'      => 'Utilise un couteau bien aiguisé pour éviter les larmes.',
            'duration'    => 5,
        ]);

        RecipeStep::create([
            'recipe_id'   => 1,
            'step_number' => 3,
            'description' => 'Faire revenir les oignons dans une poêle avec un peu d’huile.',
            'advice'      => 'Remue régulièrement pour éviter qu’ils ne brûlent.',
            'duration'    => 7,
        ]);
    }
}
