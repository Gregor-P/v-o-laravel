@extends('layouts/layout')

@section('content')
	@auth
	{!! Form::open(['action' => 'PostsController@store']) !!}
		{{ Form::hidden('user_id', Auth::user()->id)}}

		{{ Form::text('title', '', ['required' => 'required', 
		'placeholder' => 'Title'])}}
		{{ Form::textarea('body', '', ['required' => 'required', 
		'placeholder' => 'Write your post\'s content here...']) }}
		<br/>
		{{ Form::submit('submit', ['class' => 'btn']) }}
	{!! Form::close() !!}
	@endauth
@endsection