@extends('layouts.default')

@section('content')

<div class="container bs-docs-container">
    <div class="row">
        <div class="col-md-3">
            {{ $menu }}
        </div>
        <div class="col-md-9" role="main">
        	{{ $page }}
        </div>
    </div>
</div>
@stop