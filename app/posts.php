<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $primaryKey = 'post_id';
	
	public function categories(){
		return $this->belongsTo('App\categories','category_id','category_id');
	}
	
	public function users(){
		return $this->belongsTo('App\Users','id','user_id');
	}
}
