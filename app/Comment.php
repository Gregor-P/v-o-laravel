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


}
