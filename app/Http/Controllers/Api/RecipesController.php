<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RecipesController
{
    public function getRecipes()
    {
        $user = auth()->user();

        $recipes = Recipe::with('steps', 'ingredients')->get();

        $favoriteIds = $user
            ? $user->favoriteRecipes()->pluck('recipes.id')->toArray()
            : [];

        $recipes->transform(function ($recipe) use ($favoriteIds) {
            $recipe->favorite = in_array($recipe->id, $favoriteIds);
            if ($recipe->image) {
                $recipe->image = Storage::disk('r2')->temporaryUrl(
                    $recipe->image,
                    now()->addMinutes(20)
                );
            } else {
                $recipe->image = null;
            }

            return $recipe;
        });

        return response()->json($recipes);
    }
    public function store(Request $request)
    {
        // Validation des champs
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:entrée,plat,dessert',
            'preparation_time' => 'required|integer|min:0',
            'difficulty' => 'required|string|in:facile,moyen,difficile',
            'image' => 'nullable|image|max:2048',
            'ingredients.*.label' => 'required|string',
            'ingredients.*.quantity' => 'nullable|string',
            'steps.*.step_number' => 'required|integer',
            'steps.*.description' => 'required|string',
            'steps.*.advice' => 'nullable|string',
            'steps.*.duration' => 'nullable|integer',
        ]);

        // Upload dans le bucket si image présente
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Stocke dans le disk 's3' (config/storage.php), tu peux changer si local
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('r2')->putFileAs('recipes', $file, $filename, 'public');
            $data['image'] = 'recipes/' . $filename; // on stocke juste le nom
        }

        // Création de la recette
        $recipe = Recipe::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'type' => $data['type'],
            'preparation_time' => $data['preparation_time'],
            'difficulty' => $data['difficulty'],
            'image' => $data['image'] ?? null, // juste le nom
        ]);

        // Création des ingrédients
        foreach ($data['ingredients'] as $ingredient) {
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'label' => $ingredient['label'],
                'quantity' => $ingredient['quantity'] ?? null,
            ]);
        }

        // Création des étapes
        foreach ($data['steps'] as $step) {
            RecipeStep::create([
                'recipe_id' => $recipe->id,
                'step_number' => $step['step_number'],
                'description' => $step['description'],
                'advice' => $step['advice'] ?? null,
                'duration' => $step['duration'] ?? null,
            ]);
        }

        return response()->json(['message' => 'Recette créée avec succès', 'recipe' => $recipe]);
    }
    public function addFavorite($recipeId) {

        $user = auth()->user(); // ou auth()->user()

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        $user->favoriteRecipes()->attach($recipeId);
        return response()->json(['message' => 'Recette ajoutée aux favoris']);
    }
    public function removeFavorite($recipeId)
    {
        $user = auth()->user();

        // On détache la recette des favoris de l'utilisateur
        $user->favoriteRecipes()->detach($recipeId);

        return response()->json([
            'message' => 'Recette retirée des favoris avec succès',
            'recipe_id' => $recipeId,
        ]);
    }

    public function getFavorites()
    {
        $user = auth()->user();
        $favorites = $user->favoriteRecipes()->get(); // renvoie les recettes favorites

        return response()->json($favorites);
    }

}
