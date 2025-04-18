<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Comment;

class BlogController extends Controller
{
    // Admin - Index Page
    public function index(Request $request)
    {
        $query = Blog::latest(); // Fetch latest blogs first

        // Search by title or content
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs = $query->paginate(12); // Paginate with 10 blogs per page

        // Fetch unique categories for the filter dropdown
        $categories = Blog::select('category')->distinct()->pluck('category');

        return view('admin.blog.index', compact('blogs', 'categories'));
    }


    // Admin - Create Page
    public function create()
    {
        return view('admin.blog.create');
    }

    // Admin - Store Blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required',
            'category' => 'required',
            'content' => 'required',
            'keywords' => 'required',
            'seo_tags' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $imagePath,
            'author' => $request->author,
            'category' => $request->category,
            'content' => $request->content,
            'keywords' => $request->keywords,
            'seo_tags' => $request->seo_tags
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created Successfully');
    }

    // Admin - Show Blog
    public function show(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    // Admin - Edit Blog
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    // Admin - Update Blog
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $blog->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required',
            'category' => 'required',
            'content' => 'required',
            'keywords' => 'required',
            'seo_tags' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('blog_images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author' => $request->author,
            'category' => $request->category,
            'content' => $request->content,
            'keywords' => $request->keywords,
            'seo_tags' => $request->seo_tags
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated Successfully');
    }

    // Admin - Delete Blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Deleted Successfully');
    }

    // User - Blog Listing
    public function publicIndex(Request $request)
    {
        $query = Blog::latest();

        // Search Feature
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Filter by Category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        $blogs = $query->paginate(12);

        // Get unique categories for filter dropdown
        $categories = Blog::select('category')->distinct()->pluck('category');

        return view('blog.index', compact('blogs', 'categories'));
    }


    // User - Single Blog Page
    public function publicShow($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Fetch related blogs (same category, exclude current blog)
        $relatedBlogs = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id) // Exclude the current blog
            ->latest()
            ->take(3)
            ->get();

        // Fetch recent blogs excluding the current one
        $recentBlogs = Blog::where('id', '!=', $blog->id) // Exclude the current blog
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'relatedBlogs', 'recentBlogs'));
    }

    // Fetch comments for a blog
    public function fetchComments($blog_id)
    {
        $comments = Comment::where('blog_id', $blog_id)
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->get();

        return response()->json($comments);
    }

    // Store a new comment
    public function storeComment(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create($request->all());

        return response()->json($comment);
    }

    public function welcome()
    {
        $latestBlogs = Blog::latest()->take(3)->get();

        return view('welcome', compact('latestBlogs'));
    }
}
