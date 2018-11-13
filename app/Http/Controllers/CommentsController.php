<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;

class CommentsController extends Controller
{
	/*
    public function comments($id)
    {
        $comments = Post::find($id);
        return view('posts.show')->with('post', $post);
    }
    */
    public function store(Request $request){
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('parent_id');
        $comment->user_id = $request->input('user_id');
        $comment->save();

        return redirect('/posts/'.$request->input('post_id'));
    }

    public function destroy(Request $request){
        $this->validate($request, [
            'comment_id' => 'required'
        ]);
        $comment_id = $request->input('comment_id');
        $comment = Comment::where(['id' => $comment_id])->delete();
        $reply = Comment::where(['post_id' => $comment_id]) ->delete();
        
        return redirect('/posts/'.$request->input('post_id'));
    }
}
