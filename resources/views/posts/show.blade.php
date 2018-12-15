@extends('layouts.layout')
@section('content')
	<?php 
		$username = App\User::find($post->user_id)->name;
	?>
	<a href="/posts" class="btn"> back </a>
	@auth
	    @if($post->user_id==Auth::user()->id)
	    	{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'class' => 'form-delete']) !!}
	    		{{Form::hidden('_method', 'DELETE')}}
	    		{{Form::hidden('post_id', $post->id)}}
	    		{{Form::submit('X', ['class' => 'btn delete'])}}
	    	{!! Form::close()!!}
	    @endif
    @endauth
	<br/><br/>
	



	<p>
		<span class="post-title">{{$post->title}} </span>
		<a href="">{{ $username}}</a>, <small> {{$post->created_at}}</small>
	</p>
	<pre class="post-body">
	{{$post->body}}
	</pre>
	

	<br/>
	@include('posts.comments', ['post_id' => $post->id, 'comments' => $comments])

@endsection