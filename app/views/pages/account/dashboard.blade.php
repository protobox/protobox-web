@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row content-container">
        <div class="col-md-9" role="main">
			<h1>Account</h1>

			<ul>
				<li><a href="{{ URL::route('logout') }}">Logout</a>
			</ul>
		</div>
	</div>
</div>
@stop