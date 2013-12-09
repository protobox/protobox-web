<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
<head>
    <title>{{ trans('global.title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ trans('global.desc') }}" />
    <meta name="author" content="Patrick Heeney - https://github.com/patrickheeney" />
    @section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('assets/css/styles-all.css') }}">
    @show
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="{{ asset('assets/js/scripts-all.js') }}"></script>
<script>
var PROTOBOX_CONFIG = {
	UPLOAD: '{{ URL::route('upload') }}'
};
</script>
@show

@include('partials.tracking')
</body>
</html>