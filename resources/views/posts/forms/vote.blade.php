
<?php
$column = array();
$relation = Auth::user()->comments();
$comment = App\Comment::where('id', $comment_id)->first();
$select = $relation->where('comment_id', $comment_id)->first();

if($select == NULL){									//če še ne obstaja
	$relation->attach($comment_id, ['rating' => 1]);	//potem naredi relacijo
	$comment->points+=1;
}
else{													//če obstaja...
	switch ($select->ratings->rating) {
		case -1:
			$column['rating'] = 1;
			$comment->points+=1;
			break;
		case 0:
			$column['rating'] = 1;
			$comment->points+=1;
			break;
		case 1:
			$column['rating'] = 0;
			$comment->points-=1;
			break;
	}
	$relation->updateExistingPivot($comment_id, $column);//posodobi relacijo
}
$comment->save();

return redirect()->back()->send();
