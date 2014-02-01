<input type="hidden" name="queues[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

@if (count($section->queues()))
<ul class="nav nav-pills nav-section">
    @foreach($section->queues() as $type => $name)
    <li class="{{ $type == 'rabbitmq' ? 'active' : '' }}"><a href="#section-queues-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
	<div class="tab-pane active" id="section-queues-rabbitmq">
        @include('pages.builder.sections.queues._rabbitmq')
	</div>
	<div class="tab-pane" id="section-queues-beanstalkd">
		<div class="alert alert-warning fade in">
			<strong>Beanstalkd</strong> is coming soon.
		</div>
	</div>
	<div class="tab-pane" id="section-queues-ironmq">
		<div class="alert alert-warning fade in">
			<strong>IronMQ</strong> does not need anything installed on the server. We suggest you use a framework or package that integrates this service in your application.
		</div>
	</div>
	<div class="tab-pane" id="section-queues-amazonsqs">
		<div class="alert alert-warning fade in">
			<strong>Amazon SQS</strong> does not need anything installed on the server. We suggest you use a framework or package that integrates this service in your application.
		</div>
	</div>
</div>

@include('pages.builder._continue')

@include('pages.builder._create')
