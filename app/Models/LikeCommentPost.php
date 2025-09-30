<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeCommentPost extends Model
{
    use HasFactory;

    protected $table = 'likes_comment_post'; // correspond à ta table

    protected $fillable = [
        'user_id',
        'comment_id',
    ];

    /**
     * Relation : ce like appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : ce like appartient à un commentaire.
     */
    public function comment()
    {
        return $this->belongsTo(CommentPost::class, 'comment_id');
    }
}
