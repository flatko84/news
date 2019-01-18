@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<a href="/post">To List</a>
            <div class="card">
				<h3>Post Add/Edit</h3>
				<form id="post-form">
				
				{{ csrf_field() }}
				<table>
					<tr>
						<td>
							Title:
						</td>
						<td>
							<input type="text" name="title">
						</td>
								<td><div id="title-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							Content:
						</td>
						<td>
							<textarea name="content"></textarea>
						</td>
						<td><div id="content-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							Tags:
						</td>
						<td>
							<input type="text" name="tags" value="">
						</td>
						<td><div id="tags-error" class="error"></div></td>
					</tr>
					<tr>
						<td>
							SEO URL:
						</td>
						<td>
							<input type="text" name="seo_url" value="">
						</td>
						<td><div id="seo_url-error" class="error"></div></td>
					</tr>
					<tr><td></td><td>
							<input type="button" value="Save" id="send-post"></td></tr>
				</table>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('ajax')
<script src="{{ asset('js/post.js') }}" defer></script>
@endsection
