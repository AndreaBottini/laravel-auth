<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    private $validateRules;

    public function __construct()
    {
    
        $this->validateRules = [
            'title' => 'required|string',
            'body' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'post_id' => 'required|numeric|exists:posts,id'
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->validateRules);
        $data = $request->all();

        $comment = new Comment;
        $comment->fill($data);
        $saved = $comment->save();

        if($saved){
            return redirect()->back();
        }

        return redirect()->route('posts.show', $comment->post->slug);

    }
}
