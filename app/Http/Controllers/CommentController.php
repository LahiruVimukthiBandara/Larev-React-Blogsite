<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $validated = $request->validate( [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'string|max:1000',
        ] );

        Comment::create( [
            'user_id' => $validated[ 'user_id' ],
            'post_id' => $validated[ 'post_id' ],
            'comment' => $validated[ 'comment' ],
            'status' => 0,
        ] );

        return redirect()->back()->with( 'success', 'Comment added!' );
    }

    /**
    * Display the specified resource.
    */

    public function show( Comment $comment ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Comment $comment ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, Comment $comment ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Comment $comment ) {
        //
    }
}
