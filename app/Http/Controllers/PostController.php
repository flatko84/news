<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $rules = [
        'title' => 'required|min:5|max:30',
        'content' => 'required|min:30|max:400',
        'tags' => 'required',
        'image' => 'image | max:1000',
        'seo_url' => 'required|alpha_dash|unique:posts,seo_url',
        'category_id' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $posts = ($user->admin == true) ? Posts::all() : Posts::where('user_id', $user_id)->get();
        $posts_data = array();
        foreach ($posts as $post){
            $posts_data[] = [
                'post_id' => $post->post_id,
                'title' => $post->title,
                'user' => $post->users->name
            ];
        }
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return json_encode(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insert = $request->validate($this->rules);
        $insert['user_id'] = Auth::id();
        $path = $request->file('image')->store('public');
        $insert['image'] = substr($path, 7);
        $post = Posts::create($insert);

        return json_encode($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Posts::where('post_id', $id)->first();
        $this->authorize('view', $post);
        return view('post.show', ['post' => $post, 'user' => $post->users->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::where('post_id', $id)->first();
        $this->authorize('update', $post);
        $categories = Categories::all();
        return json_encode(['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->rules['seo_url'] .= ',' . $id . ',post_id';
        $post = Posts::where('post_id', $id)->first();
        
        $this->authorize('update', $post);
        $update = $request->validate($this->rules);

          if ($request->file('image')) {
            $path = $request->file('image')->store('public');
            $update['image'] = substr($path, 7);
        }

        $post = Posts::where('post_id', $id)->update($update); 

        return json_encode($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Posts::where('post_id', $id)->first();
        $this->authorize('delete', $post);
        Posts::where('post_id', $id)->delete();
        return redirect('/post');
    }

    public function categories(){
        $categories = Categories::all();
        return json_encode($categories);
    }


}
