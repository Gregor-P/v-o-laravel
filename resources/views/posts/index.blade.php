@extends('layouts.layout')
@section('content')
@auth
<a href="/posts/create" class="btn" style="float: left; clear: both;"> make post </a>
@endauth
<br/>
<form>
	<select>
		<option> # replies</option>
		<option> date </option>
		<option>  </option>
	</select>
</form>
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
					<i><span style="float: right">
						replies: {{ DB::table('comments')->where('post_id', $post->id)->count()}}
					</span></i>
				</div>
			</p>
		</div>
	@endforeach
@else
	<i>No posts found </i>
@endif
@endsection

