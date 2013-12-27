@extends('layouts.default')

@section('content')

<div class="container main-content">
    <div class="row">
        <div class="col-md-12">
            <h1 class="primary">{{ $box->name }}</h1>
            <p>{{ $box->description }}</p>
            <hr />
            <h2>Install Box</h2>
            <p>If you already have protobox installed, run this command to install this configuration in your protobox directory:</p>
            <p>
                <input type="text" name="share_box" value="ruby protobox install '{{ URL::route('explore.show', ['id' => $id]) }}'" class="form-control" readonly="readonly">
            </p>
            <p>
                <a href="{{ URL::route('explore.edit', ['id' => $id]) }}" class="btn btn-primary">Edit</a>
                <a href="{{ URL::route('explore.raw', ['id' => $id]) }}" class="btn btn-primary">Raw</a>
                <a href="{{ URL::route('explore.download', ['id' => $id]) }}" class="btn btn-primary">Download</a>
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