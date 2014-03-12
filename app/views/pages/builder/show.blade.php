@extends('layouts.default')

@section('content')

@include('partials.header_build')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<hr />
            <div class="row">
                <div class="col-md-5">
                    <h1 class="primary">Your box is ready!</h1>
                    <p class="lead">Congratulations, you just built the configuration file to your right.</p>
                    <p>If you do not have protobox installed yet, please follow the <a href="http://getprotobox.com/docs/installation" target="_blank">protobox installation guide</a>. Once installed, open terminal to your protobox directory and paste the command in the textbox below. Alternatively you can click on the download button and copy the file to <code>data/config/</code> in your protobox directory.</p>
                    <p>
                    	<input type="text" name="share_box" value="vagrant protobox install '{{ Url::route('builder.show', ['id' => $id]) }}'" class="form-control" readonly="readonly">
                    </p>
                    <p>
                    	<a href="{{ URL::route('builder.edit', ['id' => $id]) }}" class="btn btn-primary">Edit</a>
                    	<a href="{{ URL::route('builder.raw', ['id' => $id]) }}" class="btn btn-primary">Raw</a>
                    	<a href="{{ URL::route('builder.download', ['id' => $id]) }}" class="btn btn-primary">Download</a>
                    	<a href="{{ URL::route('builder.delete', ['id' => $id]) }}" class="btn">Delete</a>
                    </p>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-7">
                    <h3>Your configuration file:</h3>
                    <pre class="code-block">{{{ $code }}}</pre>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr />
            <h3>What is a configuration file?</h3>
            <p>A configuration file is a YAML document with a set of instructions for protobox on exactly what to install on your virtual machine. By placing this file into your protobox directory you are telling protobox how to communicate with vagrant and what to install when vagrant is booting up for the first time.</p>
        </div>
    </div>
</div>

@stop