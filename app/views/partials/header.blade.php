<div class="navbar navbar-inverse navbar-fixed-top navbar-main">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ URL::to('/') }}" class="navbar-brand">protobox</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') || Request::is('share/*') ? 'active' : '' }}"><a href="{{ URL::to('/') }}">{{ strtoupper(trans('global.nav_main.build')) }}</a></li>
                <li class="{{ Request::is('explore') || Request::is('explore/*') ? 'active' : '' }}"><a href="{{ URL::route('explore') }}">{{ strtoupper(trans('global.nav_main.explore')) }}</a></li>
                <li class="{{ Request::is('docs/about') ? 'active' : '' }}"><a href="{{ URL::route('docs') }}/about/">{{ strtoupper(trans('global.nav_main.about')) }}</a></li>
                <li class="{{ Request::is('docs/roadmap') ? 'active' : '' }}"><a href="{{ URL::route('docs') }}/roadmap/">{{ strtoupper(trans('global.nav_main.roadmap')) }}</a></li>
                <li class="{{ Request::is('docs') || Request::is('docs/*') && !Request::is('docs/about') && !Request::is('docs/roadmap') ? 'active' : '' }}"><a href="{{ URL::route('docs') }}">{{ strtoupper(trans('global.nav_main.docs')) }}</a></li>
                <li><a href="https://github.com/protobox/protobox/issues" target="_blank">{{ strtoupper(trans('global.nav_main.issues')) }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                {{-- @if (Auth::check())
                <li class="{{ Request::is('account') || Request::is('account/*') ? 'active' : '' }} register"><a href="{{ URL::route('account') }}">{{ strtoupper('Account') }}</a></li>
                @else
                <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ URL::route('login') }}">{{ strtoupper(trans('global.nav_main.login')) }}</a></li>
                <li class="{{ Request::is('register') ? 'active' : '' }} register"><a href="{{ URL::route('register') }}">{{ strtoupper(trans('global.nav_main.register')) }}</a></li>
                @endif --}}
                <li class="register"><a href="https://github.com/protobox/protobox" target="_blank">GitHub</a></li>
            </ul>
        </div>
    </div>
</div>