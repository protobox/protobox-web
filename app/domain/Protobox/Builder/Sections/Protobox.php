<?php namespace Protobox\Builder\Sections;

use Config;

class Protobox extends Section {

	public function load($output)
	{
		return [
			'protobox' => [
				'version' => isset($output['protobox']['version']) ? $output['protobox']['version'] : '',
				'build' => isset($output['protobox']['build']) ? $output['protobox']['build'] : '',
				'document' => isset($output['protobox']['document']) ? $output['protobox']['document'] : '',
				'description' => isset($output['protobox']['description']) ? $output['protobox']['description'] : '',
				'dashboard' => [
					'install' => isset($output['protobox']['dashboard']['install']) ? (int) $output['protobox']['dashboard']['install'] : 1,
					'path' => isset($output['protobox']['dashboard']['path']) ? $output['protobox']['dashboard']['path'] : '',
				],
			]
		];
	}

	public function output($options = [])
	{
		$protobox = $this->builder->request()->get('protobox');
		$box_id = isset($options['box_id']) ? $options['box_id'] : null;

		return [
			'protobox' => [
				'version' => Config::get('protobox.version'),
				'build' => 'custom',
				'document' => $box_id,
				'description' => 'A custom build from '.($box_id ? 'getprotobox.com/share/'.$box_id : 'getprotobox.com'),
				'dashboard' => [
					'install' => isset($protobox['dashboard']['install']) ? (int) $protobox['dashboard']['install'] : 1,
					'path' => isset($protobox['dashboard']['path']) ? $protobox['dashboard']['path'] : '',
				],
			]
		];
	}

}