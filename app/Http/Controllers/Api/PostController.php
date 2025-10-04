<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LikePost;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Récupère tous les posts.
     */
    public function getPosts(): JsonResponse
    {
        $userId = Auth::id();

        $posts = Post::with(['user', 'comments'])
            ->withExists(['likes as user_has_liked' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->get();

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
    public function like(Request $request) {
        $idPost = $request->input('id_post');
        $like = LikePost::create([
            'post_id' => $idPost,
            'user_id' => $request->user()->id,
        ]);
        return response()->json($like, 201);
    }

    public function unlike($id) {
        $userId = Auth::id();
        // Trouver le like
        $like = LikePost::where('post_id', $id)
            ->where('user_id', $userId)
            ->first();
        if (!$like) {
            return response()->json(['message' => 'Like non trouvé'], 404);
        }
        // Supprimer
        $like->delete();
        return response()->json(['message' => 'Like supprimé avec succès'], 200);
    }
}
