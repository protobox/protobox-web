@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h1 class="primary">Protoboxes</h1>
            <p>Select a protobox from the right to learn more.</p>
        </div>
        <div class="col-md-9">
        @if(count($boxes))
        	@foreach($boxes as $box)
        	<ul class="protoboxes">
	        	<li><a href="{{ URL::route('explore.show', ['id' => $box->publicID()]) }}"><strong>{{ $box->name }}</strong></a>: {{ $box->desc }}</li>
        	</ul>
        	@endforeach
        @else
        	<p>No Boxes Found</p>
        @endif
        </div>
    </div>
</div>

@stop