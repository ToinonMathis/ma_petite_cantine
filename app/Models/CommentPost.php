<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    use HasFactory;

    protected $table = 'comments_post'; // correspond à ta table

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    /**
     * Relation : le commentaire appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : le commentaire appartient à un post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relation : un commentaire peut avoir plusieurs likes.
     */
    public function likes()
    {
        return $this->hasMany(LikeCommentPost::class);
    }
}
