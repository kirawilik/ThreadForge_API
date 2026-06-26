<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Jobs\GeneratePostJob;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    // GET /api/posts
    public function index()
    {
        return auth()
            ->user()
            ->posts()
            ->latest()
            ->get();
    }

    // POST /api/posts
    public function store(StorePostRequest $request)
    {
        // Vérifie que le Blueprint appartient à l'utilisateur connecté
        $blueprint = auth()
            ->user()
            ->blueprints()
            ->findOrFail($request->blueprint_id);

        $post = Post::create([
            'user_id' => auth()->id(),
            'blueprint_id' => $blueprint->id,
            'raw_content' => $request->raw_content,
            'status' => 'pending',
        ]);

        // Lancement du Job IA
        GeneratePostJob::dispatch($post);

        return response()->json([
            'message' => 'Post submitted successfully.',
            'status' => 'pending',
            'post' => $post,
        ], 202);
    }

    // GET /api/posts/{post}
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return $post;
    }

    // DELETE /api/posts/{post}
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully.',
        ]);
    }
}