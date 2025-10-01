<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Récupère tous les posts.
     */
    public function getPosts(): JsonResponse
    {
        $posts = Post::with(['user', 'comments', 'likes'])->get();

        return response()->json($posts);
    }
}
