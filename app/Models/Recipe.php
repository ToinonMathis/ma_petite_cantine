<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'preparation_time',
        'difficulty',
        'image',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function steps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('step_number');
    }
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
