<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];

    /**
     * Relation : un post appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : un post peut avoir plusieurs commentaires.
     */
    public function comments()
    {
        return $this->hasMany(CommentPost::class); // ou Comment si ton modèle s'appelle comme ça
    }

    /**
     * Relation : un post peut avoir plusieurs likes.
     */
    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }
}
