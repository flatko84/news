<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $primaryKey = 'post_id';
    protected $table = 'posts';
    protected $fillable = ['title', 'category_id', 'user_id', 'content', 'image', 'tags', 'seo_url'];

    public function categories()
    {
        return $this->belongsTo('App\Categories', 'category_id', 'category_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
