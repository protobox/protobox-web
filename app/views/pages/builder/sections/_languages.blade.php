<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

@if (count($section->languages()))
<ul class="nav nav-pills nav-section">
    @foreach($section->languages() as $type => $name)
    <li class="{{ $type == 'php' ? 'active' : '' }}"><a href="#section-languages-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-languages-php">
        @include('pages.builder.sections.languages._php')
    </div>
    <div class="tab-pane" id="section-languages-hhvm">
        @include('pages.builder.sections.languages._hhvm')
    </div>
    <div class="tab-pane" id="section-languages-ruby">
        @include('pages.builder.sections.languages._ruby')
    </div>
</div>

@include('pages.builder._continue')

@include('pages.builder._create')
