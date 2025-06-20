<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class PostController extends Controller {
    public function index() {
        $categories = Category::all();
        $posts = Post::query()
        ->with( [ 'categories', 'user' ] )
        ->where( 'active', '=', 1 )
        ->where( 'published_date', '!=', null )
        ->orderBy( 'published_date', 'desc' )
        ->paginate( 8 );

        $featured = Post::query()
        ->where('featured', '=', 1)
        ->where('active','=', 1)
        ->whereNotNull('published_date')
        ->orderBy('updated_at', 'desc')
        ->take(5)
        ->get();

        return Inertia::render( 'Home', [ 'posts' => $posts, 'categories' => $categories, 'featured' => $featured ] );
    }

    public function show(Request $request, Post $post)
{
    $post->load(['categories', 'user']);

    $comments = Comment::with('user')
        ->where('post_id', $post->id)
        ->where(function ($query) {
            $query->where('status', 1)->orWhereNull('status');
        })
        ->whereNotNull('created_at')
        ->orderBy('updated_at', 'desc')
        ->paginate(5);

    return Inertia::render('Posts/Show', [
        'post' => $post,
        'comments' => $comments,
    ]);
}
}
