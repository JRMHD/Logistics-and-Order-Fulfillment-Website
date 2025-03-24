<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Admin - View all comments
    public function index()
    {
        $comments = Comment::latest()->paginate(15);
        return view('admin.comments.index', compact('comments'));
    }

    // Admin - Show single comment
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    // Admin - Delete comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comment Deleted Successfully');
    }
}
