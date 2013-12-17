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
			'newrelic_php' => 0

		];
	}

}
