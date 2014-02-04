<input type="hidden" name="ngrok[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

{{-- @if (count($section->groups()))
<ul class="nav nav-pills nav-section">
    @foreach($section->groups() as $type => $name)
    <li class="{{ $type == 'tunneling' ? 'active' : '' }}"><a href="#section-tools-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif --}}

{{-- <div class="tab-content">
    <div class="tab-pane active" id="section-tools-tunneling"> --}}

@include('pages.builder.sections.tools._localtunnel')

@include('pages.builder.sections.tools._monitoring')

@include('pages.builder.sections.tools._protobox')

{{--    </div>
</div> --}}

@include('pages.builder._continue')

@include('pages.builder._create')
