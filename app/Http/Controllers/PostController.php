<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->with(['user', 'likes', 'replies.user']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter posts by specific user
    if ($request->has('username')) {
        $userName = $request->input('username');
        $query->whereHas('user', function ($query) use ($userName) {
            $query->where('name', 'like', '%' . $userName . '%');
        });
    }

    // Sorting functionality
    switch ($request->input('sort')) {
        case 'date':
            $query->orderBy('created_at', 'desc');
            break;
        case 'popularity':
            $query->withCount('likes')->orderBy('likes_count', 'desc');
            break;
    }

    $posts = $query->paginate(10);

    return view('index', compact('posts'));
}
    public function create()
    {
        if (auth()->user()->is_disabled) {
            abort(403, "Unauthorized action.");
        }

        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
{
    $post = Post::findOrFail($id);

    // Ensure the logged-in user is the owner of the post
    if ($post->user_id != auth()->id()) {
        abort(403, 'Unauthorized access.');
    }

    return view('edit', compact('post'));
}
    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Ensure the logged-in user is the owner of the post
    if ($post->user_id != auth()->id()) {
        return redirect()->route('index')->with('error', 'Unauthorized access.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    // Update the post with the new data
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    // Redirect back to the index view with a success message
    return redirect()->route('index')->with('success', 'Post updated successfully.');
}
   public function destroy($id)
{
    $post = Post::findOrFail($id);
    $user = auth()->user();

    // Allow deletion if the user is the owner or an admin
    if ($post->user_id != $user->id && !$user->is_admin) {
        abort(403, 'Unauthorized access.');
    }

    $post->delete();
    return redirect()->route('index')->with('success', 'Post deleted successfully.');
}

     public function like(Post $post)
    {
        $post->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function reply(Request $request, Post $post)
    {
        $request->validate(['body' => 'required|string']);
        $post->replies()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}
