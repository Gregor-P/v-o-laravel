<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $param = $request->input('param', 'desc');
        $tags = $request->input('tags');
        $tagsArray = explode(" ", $tags);

        $posts = Post::query();
        if($tagsArray[0] != ""){
            foreach ($tagsArray as $t) {
                $posts->where('tags', 'LIKE', '%'.$t.'%');
            }
        }
    
        $posts = $posts->orderBy('created_at', $param)->get();
        return view('posts.index')->with('posts', $posts)->with('tags', $tags); 
    }

    public function index(Request $request)
    {

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'title' => 'required',
        'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        $post->tags = $request->input('tags', ' ');
        $post->save();

        return redirect('/posts/'.$request->input('post_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->where('is_reply', 0)->orderBy('points', 'desc')->get();
        return view('posts.show')->with('post', $post)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required'
        ]);
        $post_id = $request->input('post_id');
        $comments = Comment::where(['post_id' => $post_id])->get();

        foreach ($comments as $c){
            $reply = Comment::where('post_id', $c->id)->get();

            foreach ($reply as $r){
                if($r->is_reply)
                    $r->delete();
            }
            $c->delete();
        }

        $post = Post::where('id', $post_id);
        $post->delete();
        
        return redirect('/posts');
    }

}
