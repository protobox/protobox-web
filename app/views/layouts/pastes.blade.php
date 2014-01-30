<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
<head>
    <title>{{ trans('global.title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ trans('global.desc') }}" />
    <meta name="author" content="Patrick Heeney - https://github.com/patrickheeney" />
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pastes.v0.0.3.css') }}">
    @show
</head>
<body onload="prettyPrint()">

<div class="header">
    <a class="logo" href="{{ URL::to('/') }}">protobox</a>
    <ul class="buttons">
        @yield('buttons')
    </ul>
</div>

@yield('content')

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="{{ asset('assets/js/pastes.v0.0.3.min.js') }}"></script>
<script type="text/javascript">
$(function() {
    $('textarea').focus().tabby();
    $('.save').click(function() {
        createPaste();
    });

    function createPaste()
    {
        $("#paster").submit();
    }
});
</script>
@show

@include('partials.tracking')
</body>
</html>