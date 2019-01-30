@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post">To List</a>
            <div class="card">
				<h3>Post Add/Edit</h3>
				{{ Form::open(array('route' => 'post.store', 'files' => true)) }}

				{{ csrf_field() }}
				<table>
					<tr>
						<td>
							Title:
						</td>
						<td>
							{{ Form::text('title', old('title')) }}

						</td>
								<td><div id="title-error" class="error">{{ $errors->first('title') }}</div></td>
					</tr>
					<tr>
						<td>
							Content:
						</td>
						<td>
							{{ Form::textarea('content', old('content')) }}
						</td>
						<td><div id="content-error" class="error">{{ $errors->first('content') }}</div></td>
					</tr>
					<tr>
						<td>
							Image:
						</td>
						<td>
							{{ Form::file('image', old('image')) }}
						</td>
						<td><div id="tags-error" class="error">{{ $errors->first('tags') }}</div></td>
					</tr>
					<tr>
						<td>
							Tags:
						</td>
						<td>
							{{ Form::text('tags', old('tags')) }}
						</td>
						<td><div id="tags-error" class="error">{{ $errors->first('tags') }}</div></td>
					</tr>
					<tr>
						<td>
							SEO URL:
						</td>
						<td>
							{{ Form::text('seo_url', old('seo_url')) }}
						</td>
						<td><div id="seo_url-error" class="error">{{ $errors->first('seo_url') }}</div></td>
					</tr>
					<tr>
						<td>
							Category:
						</td>
						<td>
							<select name="category_id">
								@foreach ($categories as $category)
								<option value='{{ $category['category_id'] }}'> {{ $category['title'] }}
									@endforeach
							</select>
						</td>
						<td><div id="seo_url-error" class="error">{{ $errors->first('category') }}</div></td>
					</tr>
					<tr><td></td><td>
							{{ Form::submit('Save') }}</td></tr>
				</table>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection

