<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Reply;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Get all users
        $posts = Post::all(); // Get all posts
        return view('admindashboard', compact('users', 'posts'));
    }
    
    public function showPost($post_id)
    {
        $post = Post::with('replies')->findOrFail($post_id);
        return view('managepost', compact('post'));
    }
    
    
    
    public function toggleUser(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'User status updated successfully!');
    }
    
    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully!');
    }
    
    public function deleteReply(Reply $reply)
    {
        $reply->delete();
        return back()->with('success', 'Reply deleted successfully!');
    }
    

}
