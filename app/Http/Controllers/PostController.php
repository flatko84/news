<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
	
	
	protected $rules = [
					'title' => 'required|min:5|max:30|alpha_num',
					'content' => 'required|min:30|max:400',
					'tags' => 'required',
					'seo_url' => 'required|unique:posts,seo_url|alpha_dash'
				];
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$posts = Posts::where('user_id', Auth::id())->get();
		return view('post.index', ['posts' => $posts]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('post.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$json = Posts::create($this->validate($request, $rules)
		);
		
		return json_encode($json);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$post = Posts::where('post_id', $id)->first();
		return view('post.show', ['post' => $post]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$post = Posts::where('post_id', $id)->first();
		return view('post.edit', ['post' => $post]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$json = Posts::where('post_id', $id)->update(
				$this->validate($request, $rules)
		);
		return json_encode($json);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Posts::where('post_id', $id)->delete();
	}

}
