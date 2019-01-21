@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="{{ route('post.create') }}">New post</a>
			<div class="card">
				<fo			rm method="post">
					<table>
						<tr>
							<td>
								Name
							</td>
							<td>
								Operations
							</td>
						</tr>
						@foreach ($posts as $post)												)

						<tr>
							<td>
								<a href="/post/{{ $post['post_id'] }}/edit">{{ $post['title'] }}</a>
							</td>
							<td>
								<a onClick="delete(this.name)" name="{{  }}">Delete</a>
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