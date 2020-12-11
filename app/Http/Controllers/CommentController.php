<?php

namespace App\Http\Controllers;
use App\Models\Sujet;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this ->middleware('auth');

    }

    public function store(Sujet $sujet)
    {
        request()->validate([
            'contenu'=>'required|min:5'

        ]);

        $comment = new Comment();
        $comment->contenu = request('contenu');
        $comment->user_id=auth()->user()->id;

        $sujet->comments()->save($comment);

        return redirect()->route('sujets.show', $sujet);
    }

    public function destroy(Sujet $sujet, Comment $comment)
    {
        
        Comment::destroy($comment);

        return back();
    }
}
