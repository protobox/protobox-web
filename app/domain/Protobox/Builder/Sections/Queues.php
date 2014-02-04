<?php namespace Protobox\Builder\Sections;

class Queues extends Section {

	public function queues()
	{
		return [
			'rabbitmq' => 'RabbitMQ',
			'beanstalkd' => 'Beanstalkd',
			'ironmq' => 'IronMQ',
			'amazonsqs' => 'Amazon SQS'
		];
	}

	public function defaults()
	{
		return [

			//
			// Rabbit MQ
			//
			
			'rabbitmq_install' => 0,

		];
	}

	public function fields()
	{
		return [
			'rabbitmq.install' => 'RabbitMQ Installation',
		];
	}

	public function load($output)
	{
		return [
			'rabbitmq' => [
				'install' => isset($output['rabbitmq']['install']) ? (int) $output['rabbitmq']['install'] : 0,
			]
		];
	}

	public function output($options = [])
	{
		$rabbitmq = $this->builder->request()->get('rabbitmq');
		
		return [
			'rabbitmq' => [
				'install' => isset($rabbitmq['install']) ? (int) $rabbitmq['install'] : 0,
			]
		];
	}

}