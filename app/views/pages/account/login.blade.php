@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row content-container">
        <div class="col-md-9" role="main">
			<h1>Login</h1>

			@if (Session::has('errors'))
			<div class="alert alert-danger">
				@foreach(Session::get('errors')->all() as $error)
				<p>
					{{ $error }}
				</p>
				@endforeach
			</div>
			@endif

			@if (Session::has('login_errors'))
			<div class="alert alert-danger">
				<p>
					Login Incorrect.
				</p>
			</div>
			@endif

			<form method="post" action="{{ route('login') }}" class="form-horizontal">
				<p>
					<input type="text" id="inputEmail" name="email" placeholder="Email" value="{{ Input::old('email') }}">
				</p>
				<p>
					<input type="password" id="inputPassword" name="password" placeholder="Password">
				</p>
				<p>
					<label class="checkbox"><input type="checkbox" name="remember" value="yes" {{ Input::old('remember') == 'yes' ? 'checked="checked"' : '' }}> Remember me</label>
				</p>
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
		</div>
	</div>
</div>
@stop