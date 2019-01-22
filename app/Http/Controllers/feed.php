<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Categories;

class feed extends Controller
{
    public function index(){
		$posts = Posts::orderBy('created_at', 'desc')->get();
		return view('feed', ['posts' => $posts]);
	}
	
	public function post($seo_url){
		$post = Posts::where('seo_url', $seo_url)->first();
		
		
		return view('post', ['post' => $post, 'user' => $post->users->name]);
	}
	
	public function category($category_id){
		
		$posts = Posts::where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
		return view('category', ['posts' => $posts]);
	}
}
