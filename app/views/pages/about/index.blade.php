@extends('layouts.default')

@section('content')

@include('partials.header_build')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<hr />
            <h1 class="primary">About Protobox</h1>
            <p>Protobox is an application built on top of Vagrant that allows a single YAML configuration file to control everything that is installed on the vagrant box. The Web Interface allows you to easily edit, configure, and share your protoboxes. The project was originally inspired by the great work done by the PuPHPet team.</p>
        </div>
    </div>
</div>

@stop