@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post/create">New post</a>
            <div class="card">
				<table>
					<tr><td>Name</td></tr>
					@foreach ($posts as $post)
					
					<tr><td><a href="/post/edit/{{ $post['post_id'] }}">{{ $post['title'] }}</a></td></tr>
					
					@endforeach
					
				</table>
            </div>
        </div>
    </div>
</div>
@endsection
