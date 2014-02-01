@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row content-container">
        <div class="col-md-9" role="main">
			<h1>Register</h1>

			@if (Session::has('errors'))
			<div class="alert alert-danger">
				@foreach(Session::get('errors')->all() as $error)
				<p>
					{{ $error }}
				</p>
				@endforeach
			</div>
			@endif

			<form method="post" action="{{ route('register') }}" class="form-horizontal">
				<p>
					<input type="text" id="inputName" name="name" placeholder="Name" value="{{ Input::old('name') }}">
				</p>
				<p>
					<input type="text" id="inputEmail" name="email" placeholder="Email" value="{{ Input::old('email') }}">
				</p>
				<p>
					<input type="password" id="inputPassword" name="password" placeholder="Password">
				</p>
				<p>
					<label class="checkbox"><input type="checkbox" name="remember"> Remember me</label>
				</p>
				<button type="submit" class="btn btn-primary">Register</button>
			</form>
		</div>
	</div>
</div>
@stop