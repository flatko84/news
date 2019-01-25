@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
					<table><tr><td>User</td><td>Admin</td></tr>
					@foreach ($users as $user)

					<tr><td>{{ $user->name }}</td><td><input type="checkbox" @if ($user->admin == true) checked @endif  ></td></tr>
					<br>
					@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
