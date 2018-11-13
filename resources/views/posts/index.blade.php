@extends('layouts.layout')
@section('content')
<a href="/posts/create" class="btn" style="float: left; clear: both;"> make post </a>
<br/>

@if(count($posts) >= 1)
	@foreach($posts as $post)

		<div class="well" >
			<?php 
			/*
				//$user_id = $post->user_id;
	    		//$username = App\User::find($user_id)->name;
						@auth
			    @if($user_id==Auth::user()->id) <!-- add admin verification as well-->
			    	{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'class' => 'form-delete']) !!}
			    		{{Form::hidden('_method', 'DELETE')}}
			    		
			    		{{Form::hidden('post_id', $post->id)}}

			    		{{Form::submit('X', ['class' => 'btn delete'])}}
			    	{!! Form::close()!!}
 
		    @endauth 
		    */
			?>
			<p class="post-index">
				<span class="post-title">
					<a href="/posts/{{$post->id}}">{{$post->title}} </a>
				</span>
				<small> {{$post->created_at}}</small>
			
				<div class="post-preview"> 
					{{$post->body}}
					<br/>
					<i><span style="float: right">
						replies: {{ DB::table('comments')->where('post_id', $post->id)->count()}}
					</span></i>
				</div>
			</p>
		
		</div>
	@endforeach
@else
	<p>No posts found </p>
@endif
@endsection

