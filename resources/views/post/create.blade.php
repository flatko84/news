@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post">To List</a>
            <div class="card">
				<h3>Post Add/Edit</h3>
				<form id="post-form" action="{{ route('post.store') }}" method="POST">
				{{ csrf_field() }}
				<table>
					<tr>
						<td>
							Title:
						</td>
						<td>
							<input type="text" name="title" value="{{ old('title') }}">
						</td>
								<td><div id="title-error" class="error">{{ $errors->first('title') }}</div></td>
					</tr>
					<tr>
						<td>
							Content:
						</td>
						<td>
							<textarea name="content">{{ old('content') }}</textarea>
						</td>
						<td><div id="content-error" class="error">{{ $errors->first('content') }}</div></td>
					</tr>
					<tr>
						<td>
							Tags:
						</td>
						<td>
							<input type="text" name="tags" value="{{ old('tags') }}">
						</td>
						<td><div id="tags-error" class="error">{{ $errors->first('tags') }}</div></td>
					</tr>
					<tr>
						<td>
							SEO URL:
						</td>
						<td>
							<input type="text" name="seo_url" value="{{ old('seo_url') }}">
						</td>
						<td><div id="seo_url-error" class="error">{{ $errors->first('seo_url') }}</div></td>
					</tr>
					<tr><td></td><td>
							<input type="submit" value="Save" id="send-post"></td></tr>
				</table>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

