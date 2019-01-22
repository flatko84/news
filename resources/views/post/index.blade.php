@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="{{ route('post.create') }}">New post</a>
			<div class="card">
				
				<form method="POST" id="del-form">
					@method('DELETE')
					{{ csrf_field() }}
					<table>
						
						@foreach ($posts as $post)

						<tr>
							<td>
								{{ $post['title'] }}
							</td>
							<td>
								<a href="/post/{{ $post['post_id'] }}">Show</a>
							</td>
							<td>
								<a href="/post/{{ $post['post_id'] }}/edit">Edit</a>
							</td>
							<td>
								<a href="javascript:del({{ $post['post_id'] }})">Delete</a>
							</td>
						</tr>

						@endforeach

					</table>
					</form>
			</div>
		</div>
	</div>
</div>
@endsection


@section('ajax')
<script src="{{ asset('js/delete.js') }}" defer></script>
@endsection