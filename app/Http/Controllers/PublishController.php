<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
USE Illuminate\Support\Facades\Auth;

class PublishController extends Controller {

	public function getPosts() {
		$posts = Posts::where('user_id', Auth::id())->get();

		return view('publisher.myposts', ['posts' => $posts]);
	}

	public function postForm($post_id = '0') {

		$post = Posts::where('post_id', $post_id)->first();

		if ($post !== null) {

        $model::update( $request->validate($request, [
		]));
			
			
			
			$response = [
				'title' => $post->title,
				'content' => $post->content,
				'tags' => $post->tags,
				'seo_url' => $post->seo_url
			];
		} else {
			$response = [
				'title' => '',
				'content' => '',
				'tags' => '',
				'seo_url' => ''
			];
		}
		$response['post_id'] = $post_id;
		$response['action'] = route('publish');
		return view('publisher.postform', $response);
	}

	public function publishPost(Request $request) {
		
		//validate request
		$this->validate($request, [
			'title' => 'required|min:5|max:30|alpha_num',
			'content' => 'required|min:30|max:400',
			'tags' => 'required',
			'seo_url' => 'required|unique:posts,seo_url|alpha_dash'
		]);

		//set fields
		$data = [
			'title' => $request->title,
			'category_id' => '1',
			'user_id' => Auth::id(),
			'content' => $request->content,
			'image' => '',
			'tags' => $request->tags,
			'seo_url' => $request->seo_url
		];
		if ($request->post_id == '0') {
			$post = Posts::create($data);
			$response = $post->post_id;
		} else {
			$response = Posts::where('post_id', $request->post_id)->update($data);
		}

		return json_encode($response);
	}

}