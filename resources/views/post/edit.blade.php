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
				<form id="post-form">
				<input type="hidden" name="post_id" id="post-id" value="{{ $post->post_id }}">
				{{ csrf_field() }}
				<table>
					<tr>
						<td>
							Title:
						</td>
						<td>
							<input type="text" name="title" value="{{ $post->title }}">
						</td>
								<td><div id="title-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							Content:
						</td>
						<td>
							<textarea name="content">{{ $post->content }}</textarea>
						</td>
						<td><div id="content-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							Tags:
						</td>
						<td>
							<input type="text" name="tags" value="{{ $post->tags }}">
						</td>
						<td><div id="tags-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							SEO URL:
						</td>
						<td>
							<input type="text" name="seo_url" value="{{ $post->seo_url }}">
						</td>
						<td><div id="seo_url-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							Category:
						</td>
						<td>
							<select name="category_id">
								@foreach ($categories as $category)
								<option @if ($category['category_id'] == $post->category_id) selected @endif value='{{ $category['category_id'] }}'> {{ $category['title'] }}
								@endforeach
							</select>
						</td>
						<td><div id="seo_url-error" class="error">{{ $errors->first('category') }}</div></td>
					</tr>
					<tr><td></td><td>
							<input type="button" value="Save" id="send-post"></td></tr>
				</table>
				</form>
				@else
				You don't have permission to edit this post.
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@section('ajax')
<script src="{{ asset('js/post.js') }}" defer></script>
@endsection
