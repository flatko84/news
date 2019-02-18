@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<a href="{{ route('post.create') }}">New post</a>
			<div class="card">
			<list-component postsdata="{{ $posts }}" csrf="{{ csrf_token() }}"></list-component>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('ajax')
<script src="{{ asset('js/delete.js') }}" defer></script>
@endsection