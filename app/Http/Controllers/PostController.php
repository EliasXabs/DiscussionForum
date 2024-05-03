<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
{
    if (auth()->user()->is_disabled) {  // Assume there is an 'is_disabled' attribute
        abort(403, "Unauthorized action.");
    }

    return view('create');  // This view will contain the form for creating posts
}

    public function index(Request $request)
{
    $query = Post::with(['user', 'replies.user']);

    // Check if there's a search query
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('title', 'like', '%' . $search . '%');
    }

    // Check if there's a filter
    if ($request->has('filter') && $request->filter == 'mine') {
        $query->where('user_id', auth()->id());
    }

    $posts = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('index', compact('posts'));
}


    public function store(Request $request)
    {
        if (auth()->user()->is_disabled) {
        return redirect()->back()->with('error', 'You are not authorized to perform this action.');
    }
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'user_id' => auth()->id(),  // Ensure user is logged in
    ]);

        
        return redirect()->route('index')->with('success', 'Post created successfully.');
    }
    public function edit($id)
{
    $post = Post::findOrFail($id);

    // Ensure the logged-in user is the owner of the post
    if ($post->user_id != auth()->id()) {
        return redirect()->route('index')->with('error', 'Unauthorized access.');
    }

    return view('edit', compact('post'));
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
         public function destroy($id)
    {
        $post = Post::find($id);
        $user = auth()->user();

        // Check if the post exists and if the logged-in user is the owner or an administrator
        if (!$post || ($post->user_id != $user->id && !$user->is_admin)) {
            return redirect()->back()->with('error', 'You do not have permission to delete this post.');
        }

        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Ensure the logged-in user is the owner of the post
    if ($post->user_id != auth()->id()) {
        return redirect()->route('index')->with('error', 'Unauthorized access.');
    }

    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    // Update the post with the new data
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    // Redirect back to the index view with success message
    return redirect()->route('index')->with('success', 'Post updated successfully.');
}

}
