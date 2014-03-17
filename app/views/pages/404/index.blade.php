@extends('layouts.default')

@section('content')

<div class="container main-content">
    <div class="row">
        <div class="col-md-12">
            <h1 class="primary">{{ isset($msg) ? $msg : '404 Not Found' }}</h1>
        </div>
    </div>
</div>

@stop