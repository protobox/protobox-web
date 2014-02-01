<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

@if (count($section->drivers()))
<ul class="nav nav-pills nav-section">
    @foreach($section->drivers() as $type => $name)
    <li class="{{ $type == 'mysql' ? 'active' : '' }}"><a href="#section-datastore-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-datastore-mysql">
        @include('pages.builder.sections.datastore._mysql')
    </div>
    <div class="tab-pane" id="section-datastore-mariadb">
        @include('pages.builder.sections.datastore._mariadb')
    </div>
    <div class="tab-pane" id="section-datastore-postgresql">
        <div class="alert alert-warning fade in">
            <strong>PostgreSQL</strong> is coming soon.
        </div>
    </div>
    <div class="tab-pane" id="section-datastore-mongodb">
        <div class="alert alert-warning fade in">
            <strong>Mongdb</strong> is coming soon.
        </div>
    </div>
    <div class="tab-pane" id="section-datastore-redis">
        <div class="alert alert-warning fade in">
            <strong>Redis</strong> is coming soon.
        </div>
    </div>
    <div class="tab-pane" id="section-datastore-riak">
        <div class="alert alert-warning fade in">
            <strong>Riak</strong> is coming soon.
        </div>
    </div>
</div>

@include('pages.builder._continue')

@include('pages.builder._create')
