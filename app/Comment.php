<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use App\User;

class Comment extends Model
{
	use FormAccessible;
    protected $table = 'comments';
    //Primary key
    public $primaryKey = 'id';
    //Timestamp
    public $timestamps = true;

    public function users(){
	    return $this->belongsToMany('App\User')
	                ->using('App\CommentUser')
	                ->withPivot('rating')
	                ->as('ratings');
    }
}
