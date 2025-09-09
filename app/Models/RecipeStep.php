<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;

    protected $table = 'recipe_steps';

    // Les colonnes que l'on peut remplir en masse
    protected $fillable = [
        'recipe_id',
        'step_number',
        'description',
        'duration',
    ];

    /**
     * Relation avec la recette
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
