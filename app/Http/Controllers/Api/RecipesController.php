<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use Carbon\Carbon;

class RecipesController
{
    public function getRecipes()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }
}
