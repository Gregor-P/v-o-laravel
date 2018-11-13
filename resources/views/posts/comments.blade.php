<small id="comments-label">comments</small>
<div id="comment-section"> 

	@foreach($comments as $comment)
		<div class="comment">
			<?php 

				$user_id = $comment->user_id;
	    		$username = App\User::find($user_id)->name;

	    		$replies = App\Comment::where('post_id', $comment->id)->get();

			?>
			@auth
			    @if($user_id==Auth::user()->id) <!-- add admin verification as well-->
			    	{!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'class' => 'form-delete']) !!}
			    		{{Form::hidden('_method', 'DELETE')}}
			    		{{Form::hidden('comment_id', $comment->id)}}
			    		{{Form::hidden('post_id', $post_id)}}

			    		{{Form::submit('X', ['class' => 'btn delete'])}}
			    	{!! Form::close()!!}
			    @endif
		    @endauth
		  	<pre class="com-content"> {{ $comment->content }}</pre>
		  	<p class="com-usr-time"> {{ $username . ' , ' . $comment->created_at }}</p>
		  	
		  	<button value="{{ $comment->id}}" class="reply-btn" onclick="clickBtn(event)"> reply </button>
		  	<div class="replyToggle" id="{{ $comment->id}}" style="display: none;">
		  		@include('posts.form', ['parent_id' => $comment->id, 'post_id' => $post_id])
			</div>

			@foreach($replies as $reply)
		    	<span class="reply"> {{$reply->content}} <p style="float: right"> -{{  App\User::find($reply->user_id)->name}}</p></span>
		    @endforeach
		</div>
	@endforeach

	@include('posts.form', ['parent_id' => $post_id, 'post_id' => $post_id])

</div> 
