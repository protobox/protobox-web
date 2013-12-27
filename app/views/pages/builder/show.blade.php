@extends('layouts.default')

@section('content')

@include('partials.header_build')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<hr />
            <h1 class="primary">Your box is ready</h1>
            <p>If you already have protobox installed, run this command to install this configuration in your protobox directory:</p>
            <p>
            	<input type="text" name="share_box" value="ruby protobox install '{{ Url::route('builder.show', ['id' => $id]) }}'" class="form-control" readonly="readonly">
            </p>
            <p>
            	<a href="{{ URL::route('builder.edit', ['id' => $id]) }}" class="btn btn-primary">Edit</a>
            	<a href="{{ URL::route('builder.raw', ['id' => $id]) }}" class="btn btn-primary">Raw</a>
            	<a href="{{ URL::route('builder.download', ['id' => $id]) }}" class="btn btn-primary">Download</a>
            	<a href="{{ URL::route('builder.delete', ['id' => $id]) }}" class="btn">Delete</a>
            </p>
            <p>&nbsp;</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('partials.installation')
        </div>
    </div>
</div>

@stop