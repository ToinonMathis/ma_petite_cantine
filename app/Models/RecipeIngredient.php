<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $table = 'recipe_ingredients';

    protected $fillable = [
        'recipe_id',
        'label',
        'quantity',
    ];

    // Relation avec la recette
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
