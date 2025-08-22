<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // nom exact de la table
    protected $fillable = ['menu_date', 'starter', 'main_course', 'dairy', 'dessert'];
}

