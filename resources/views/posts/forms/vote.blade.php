<?php
$column = array();
$relation = Auth::user()->comments();

$select = $relation->where('comment_id', $comment_id)->first();
if($select == NULL){									//če še ne obstaja
	$relation->attach($comment_id, ['rating' => 1]);	//potem naredi relacijo
	echo "added";
}
else{													//če obstaja...
	switch ($select->ratings->rating) {
		case -1:
			$column['rating'] = 1;
			break;
		case 0:
			$column['rating'] = 1;
			break;
		case 1:
			$column['rating'] = 0;
			break;
	}
	$relation->updateExistingPivot($comment_id, $column);//posodobi relacijo
}

return redirect()->previous();