<input type="hidden" name="monitoring[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->platforms()))
<ul class="nav nav-pills nav-section">
    @foreach($section->platforms() as $type => $name)
    <li class="{{ $type == 'local' ? 'active' : '' }}"><a href="#section-monitoring-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif