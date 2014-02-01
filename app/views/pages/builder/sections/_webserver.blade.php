<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

@if (count($section->webservers()))
<ul class="nav nav-pills nav-section">
    @foreach($section->webservers() as $type => $name)
    <li class="{{ $type == 'apache' ? 'active' : '' }}"><a href="#section-webserver-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-webserver-apache">
        @include('pages.builder.sections.webserver._apache')
    </div>
    <div class="tab-pane" id="section-webserver-nginx">
        @include('pages.builder.sections.webserver._nginx')
    </div>
</div>

@include('pages.builder._continue')

@include('pages.builder._create')
