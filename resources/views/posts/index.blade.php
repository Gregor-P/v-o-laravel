@extends('layouts.layout')
@section('content')
<div style=" clear: both; display: inline-block; width: 100%">
@auth
<a href="/posts/create" class="btn" style="float: left;"> make post </a>
@endauth
<br/>

{!! Form::open(['action' => 'PostsController@search']) !!}
	{{Form::hidden('_method', 'POST')}}
	{{Form::select('param', ['asc' => 'Recent first', 'desc' => 'Old First'], 'New First')}}
	{{Form::text('tags','', ['placeholder'=>'search tags']) }}
	{{Form::submit('submit') }}
{!! Form::close()!!}
</div>
@if(count($posts) >= 1)
	@foreach($posts as $post)
		<div class="well" >
			<p class="post-index">
				<span class="post-title">
					<a href="/posts/{{$post->id}}">{{$post->title}} </a>
				</span>
				<small> {{$post->created_at}}</small>
			
				<div class="post-preview"> 
					{{$post->body}}
					<br/>
					@if($post->tags != NULL)
					<span class="tags">
					{{ $post->tags}}
					</span>
					@endif
					<i>
						<span style="float: right">
						replies: {{ DB::table('comments')->where('post_id', $post->id)->count()}}
						</span>
					</i>
				</div>
			</p>
		</div>
	@endforeach
@else
	<i>No posts found </i>
@endif
@endsection