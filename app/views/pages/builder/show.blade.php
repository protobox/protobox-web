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
        	<h2 class="primary">Install Protobox</h2>
        	<p>If you do not have protobox installed, please read the installation instructions below.</p>

			<h3>Installation - OSX, *nix</h3>
			<p>Open up terminal and run the following commands:</p>
			<p><code>ruby -e "$(curl -fsSL https://raw.github.com/protobox/protobox/master/ansible/shell/bootstrap)"</code></p>

			<h3>Alternatively, you can install it via git manually.</h3>
			<p>Open up terminal and run the following commands:</p>
			<p><code>
			git clone git@github.com:protobox/protobox.git protobox<br />
			cd protobox && cp data/config/common.yml-dist data/config/common.yml
			</code></p>

			<p>Make sure you add an entry to your `/etc/hosts` for any virtualhosts in your `data/config/common.yml` file:</p>
			<p><code>192.168.5.10    protobox.dev www.protobox.dev</code></p>

			<p>Then run `vagrant up` and pull up `http://protobox.dev` in your browser to see if it is setup correctly.</p>
        </div>
    </div>
</div>

@stop