<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePost extends Model
{
    use HasFactory;

    protected $table = 'likes_post'; // sinon Laravel attend "like_posts"

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * Relation : ce like appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : ce like appartient à un post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
