<?php namespace Protobox\Builder\Sections;

class Tools extends Section {

	public function groups()
	{
		return [
			'tunneling' => 'Tunneling',
			'monitoring' => 'Monitoring'
		];
	}

	public function defaults()
	{
		return [

			//
			// Local Tunnel
			//
			
			'ngrok_install' => 0,

			//
			// New Relic
			//
			
			'newrelic_install' => 0,
			'newrelic_license' => '',
			'newrelic_php' => 0,
			'newrelic_node' => 0,

		];
	}

	public function rules()
	{
		$newrelic = $this->builder->request()->get('newrelic');
		$rules = [];

		if (isset($newrelic['install']) && (int) $newrelic['install'] == 1)
		{
			$rules += [
				'newrelic.license' => 'required'
			];
		}

		return $rules;
	}

	public function fields()
	{
		return [
			'ngrok.install' => 'NGrok Installation',

			'newrelic.install' => 'NewRelic Installation',
			'newrelic.license' => 'NewRelic License',
			'newrelic.php' => 'NewRelic PHP Agent',
			'newrelic.node' => 'NewRelic Node Agent'
		];
	}

	public function load($output)
	{
		return [
			'ngrok' => [
				'install' => isset($output['ngrok']['install']) ? (int) $output['ngrok']['install'] : 0,
				'port' => isset($output['ngrok']['port']) ? (int) $output['ngrok']['port'] : 80,
			],

			'newrelic' => [
				'install' => isset($output['newrelic']['install']) ? (int) $output['newrelic']['install'] : 0,
				'license' => isset($output['newrelic']['license']) ? $output['newrelic']['license'] : '',
				'php' => isset($output['newrelic']['php']) ? (int) $output['newrelic']['php'] : 0,
				'node' => isset($output['newrelic']['node']) ? (int) $output['newrelic']['node'] : 0,
			]
		];
	}

	public function output()
	{
		$ngrok = $this->builder->request()->get('ngrok');
		$newrelic = $this->builder->request()->get('newrelic');
		
		return [
			'ngrok' => [
				'install' => isset($ngrok['install']) ? (int) $ngrok['install'] : 0,
				'port' => 80,
			],

			'newrelic' => [
				'install' => isset($newrelic['install']) ? (int) $newrelic['install'] : 0,
				'license' => isset($newrelic['license']) ? $newrelic['license'] : '',
				'php' => isset($newrelic['php']) ? (int) $newrelic['php'] : 0,
				'node' => isset($newrelic['node']) ? (int) $newrelic['node'] : 0,
			]
		];
	}

}