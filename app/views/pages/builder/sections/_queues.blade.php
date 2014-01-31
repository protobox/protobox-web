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
		<!-- rabbitmq settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">RabbitMQ</h3>
                    </div>

                    <div class="panel-body">
                        <!-- install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="rabbitmq-install">
                                    <input type="checkbox" id="rabbitmq-install" name="rabbitmq[install]" {{ Input::old('rabbitmq.install', $section->param('rabbitmq_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the <a href="http://www.rabbitmq.com/" target="_blank">RabbitMQ</a> installation.
                                </p>
                            </div>
                        </div>
                        <!-- end install -->
                    </div>
                </div>
            </div>
        </div>
		<!-- rabbitmq settings -->
	</div>
	<div class="tab-pane" id="section-queues-beanstalkd">
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

@include('pages.builder._continue')

@include('pages.builder._create')
