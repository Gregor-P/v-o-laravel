
@auth
{!! Form::open(['action' => 'CommentsController@store', 'id' => 'comment-form']) !!}
	{{ Form::hidden('user_id', Auth::user()->id)}}
	{{ Form::hidden('post_id', $post_id)}}
	{{ Form::hidden('parent_id', $parent_id)}}
	{{ Form::textarea('content', '', ['required' => 'required', 'placeholder' => 'Leave a nice comment...']) }}
	<br/>
	{{ Form::submit('submit', ['class' => 'btn']) }}
{!! Form::close() !!}
@endauth

