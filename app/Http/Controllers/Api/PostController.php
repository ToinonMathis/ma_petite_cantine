<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|file|image|max:2048',
        ]);

        // Upload de l'image si présente
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'r2'); // ou 'public'
        }

        $post = Post::create([
            'title'   => $validated['title'],
            'content' => $validated['content'],
            'image'   => $validated['image'] ?? null,
            'user_id' => $request->user()->id ?? 1, // si auth non géré, mettre 1 temporairement
        ]);

        return response()->json($post, 201);
    }
}
