@extends('layouts.pastes')

@section('buttons')
	<li><a href="{{ URL::route('bin.raw', ['id' => $id]) }}">Raw</a></li>
	<li><a href="{{ URL::route('bin.fork', ['id' => $id]) }}">Fork</a></li>
	<li><a href="{{ URL::route('bin') }}">New</a></li>
@stop

@section('content')
<pre class="prettyprint linenums"><code>{{ $paste }}</code></pre>
@stop