@extends('layouts.pastes')

@section('buttons')
	<li><a href="javascript: createPaste()" class="save">Save</a></li>
@stop

@section('content')
{{ Form::open(array('method' => 'post', 'id' => 'paster')) }}
	{{ Form::textarea('paste', Input::old('paste', $fork)) }}
	{{ Form::token() }}
{{ Form::close() }}
@stop