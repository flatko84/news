@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post">To List</a>
            <div class="card">
				<h3>Post Add/Edit</h3>
				<form-component post='{"title":"","content":"","image":"","tags":"","seo_url":"","category_id":""}' categories="{{ $categories }}" csrf="{{ csrf_token() }}" action="{{ route('post.store') }}">
				</form-component>
			</div>
		</div>
	</div>
</div>
@endsection

