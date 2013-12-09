@extends('layouts.default')

@section('content')
<div class="block-header">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Build amazing web applications together</h1>
                <p>Use protobox to build and share your vagrant virtual machines</p>
            </div>
            <div class="col-md-3">
                <a href="{{ URL::route('explore') }}" class="btn btn-primary btn-really-large pull-right">EXPLORE BOXES</a>
            </div>
        </div>
    </div>
</div>

<div class="container bs-docs-container">
    <div class="row">
        <div class="col-md-3">
            @include('pages.builder._menu')
        </div>
        <div class="col-md-9" role="main">
            {{ Form::open(['method' => 'post']) }}
            <div class="alert alert-warning fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Protobox</strong> website is a work in progress. We will remove this notice when it is in a usable form.
            </div>

            @if(count($errors->all()))
            <div class="alert alert-danger fade in" id="global_error_box">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Oh snap! You got an error!</h4>
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="build-section">
                <div class="tab-content">
                   @foreach($builder->sections() as $section)
                   <li class="tab-pane {{ $section == 'vagrant' ? 'active' : '' }}" id="section-{{ $section }}">
                        @include('pages.builder.sections._'.$section, ['section' => $builder->section($section), 'name' => $section])
                   </li>
                   @endforeach
                </div>
            </div>
            <div id="create" class="build-generate">
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-gigantic">
                            Create Manifest
                        </button>
                    </div>
                </div>
            </div>
            {{ Form::token() }}
            {{ Form::close() }}
        </div>
    </div>
    <!-- container footer -->
    <div class="row">
        <div class="col-md-12">
            <hr />
            <a href="#top">Back to top</a>
            <div class="pull-right">
                <iframe allowtransparency="true" frameborder="0" height="20px" scrolling="0" src="http://ghbtns.com/github-btn.html?user=protobox&amp;repo=protobox&amp;type=watch&amp;count=true" width="115px"></iframe>
                <iframe allowtransparency="true" frameborder="0" height="20px" scrolling="0" src="http://ghbtns.com/github-btn.html?user=protobox&amp;repo=protobox&amp;type=fork&amp;count=true" width="115px"></iframe>
                <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1384994725.html#_=1386402733982&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=getprotobox&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 116px; height: 20px;"></iframe>
                <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
                </script>
            </div>
        </div>
    </div>
</div>
@stop