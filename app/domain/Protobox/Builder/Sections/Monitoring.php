<?php namespace Protobox\Builder\Sections;

class Monitoring extends Section {

	public function platforms()
	{
		return [
			'newrelic' => 'New Relic'
		];
	}

	public function defaults()
	{
		return [

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
			'newrelic.install' => 'NewRelic Installation',
			'newrelic.license' => 'NewRelic License',
			'newrelic.php' => 'NewRelic PHP Agent',
			'newrelic.node' => 'NewRelic Node Agent'
		];
	}

	public function load($output)
	{
		return [
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
		$newrelic = $this->builder->request()->get('newrelic');
		
		return [
			'newrelic' => [
				'install' => isset($newrelic['install']) ? (int) $newrelic['install'] : 0,
				'license' => isset($newrelic['license']) ? $newrelic['license'] : '',
				'php' => isset($newrelic['php']) ? (int) $newrelic['php'] : 0,
				'node' => isset($newrelic['node']) ? (int) $newrelic['node'] : 0,
			]
		];
	}

}
