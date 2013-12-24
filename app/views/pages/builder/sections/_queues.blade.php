<input type="hidden" name="queues[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->queues()))
<ul class="nav nav-pills nav-section">
    @foreach($section->queues() as $type => $name)
    <li class="{{ $type == 'beanstalkd' ? 'active' : '' }}"><a href="#section-queues-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-queues-beanstalkd">
    	<!-- beanstalkd settings -->
		<div class="alert alert-warning fade in">
			<strong>Beanstalkd</strong> is coming soon.
		</div>
		<!-- beanstalkd settings -->
	</div>
	<div class="tab-pane" id="section-queues-ironmq">
		<!-- ironmq settings -->
		<div class="alert alert-warning fade in">
			<strong>IronMQ</strong> does not need anything installed on the server. We suggest you use a framework or package that integrates this service in your application.
		</div>
		<!-- ironmq settings -->
	</div>
	<div class="tab-pane" id="section-queues-amazonsqs">
		<!-- amazonsqs settings -->
		<div class="alert alert-warning fade in">
			<strong>Amazon SQS</strong> does not need anything installed on the server. We suggest you use a framework or package that integrates this service in your application.
		</div>
		<!-- amazonsqs settings -->
	</div>
</div>