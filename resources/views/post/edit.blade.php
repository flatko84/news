@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post">To List</a>
			<div id="success"></div>
            <div class="card">
				<h3>Post Add/Edit</h3>
				@if ($post)
			<form-component post="{{ $post }}" categories="{{ $categories }}" csrf="{{ csrf_token() }}" action="{{ route('post.update', $post->post_id) }}">
			</form-component>
			<a href="/post/{{ $post->post_id }}">Show</a>
			@else
			You don't have permission to edit this post.
			@endif
		</div>
	</div>
</div>
</div>
@endsection


