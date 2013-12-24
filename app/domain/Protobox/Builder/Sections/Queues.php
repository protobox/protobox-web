<?php namespace Protobox\Builder\Sections;

class Queues extends Section {

	public function queues()
	{
		return [
			'beanstalkd' => 'Beanstalkd',
			'ironmq' => 'IronMQ',
			'amazonsqs' => 'Amazon SQS'
		];
	}

}