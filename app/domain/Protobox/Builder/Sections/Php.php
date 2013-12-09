<?php namespace Protobox\Builder\Sections;

class Php extends Section {

	private $versions = [
		'55' => '5.5',
		'54' => '5.4',
		'53' => '5.3'
	];

	public function defaults()
	{
		return [

			//
			// PHP Settings
			//
			
			'php_install' => 1,
			'php_versions' => $this->versions,
			'php_modules' => [
				'php5-cli',
				'php5-intl',
				'php5-mcrypt',
				'php5-curl',
				'php5-gd'
			],
			'php_ini' => [
				'display_errors' => 'On',
				'display_startup_errors' => 'On',
				'error_reporting' => '-1',
				'short_open_tag' => 'On',
			],
			'php_timezone' => 'America/Chicago',

			//
			// PEAR
			//

			'pear_install' => 0,
			'pear_modules' => [],

			//
			// PECL
			//

			'pecl_install' => 0,
			'pecl_modules' => [],

			//
			// Composer
			//

			'composer_install' => 1,

			//
			// Mailcatcher
			//

			'mailcatcher_install' => 0,

			//
			// PHPMyAdmin
			//

			'phpmyadmin_install' => 0,

			//
			// Xdebug
			//

			'xdebug_install' => 1,
			'xdebug_webgrind' => 1,
			'xdebug_settings' => [
				'default_enable' => 1,
				'remote_autostart' => 0,
				'remote_connect_back' => 1,
				'remote_enable' => 1,
				'remote_handler' => 'dbgp',
				'remote_port' => 9000
			],

			//
			// Xhprof
			//

			'xhprof_install' => 0,
			'xhprof_xhgui' => 1,
			'xhprof_location' => '/srv/www/web/xhprof',

		];
	}

	public function valid()
	{
		$php = $this->builder->request()->get('php');

		// Check to see if a valid PHP version was selected
		if (
			isset($php['install']) && 
			(int) $php['install'] == 1 && 
			! in_array($php['version'], array_keys($this->versions))
		)
		{
			$this->setError('Please choose a valid PHP version.');

			return false;
		}

		return true;
	}

	public function rules()
	{
		$php = $this->builder->request()->get('php');

		if ( ! isset($php['install']) || (int) $php['install'] != 1) return [];

		return [
			'php.version' => 'required'
		];
	}

	public function fields()
	{
		return [
			'php.version' => 'PHP Version'
		];
	}

	public function output()
	{
		$php = $this->builder->request()->get('php');

		return [
			'php' => [
				'install' => isset($php['install']) ? (int) $php['install'] : 0,
				'version' => $php['version'],
				'modules' => $php['modules'],
				'pear' => [
					'install' => isset($php['pear']['install']) ? (int) $php['pear']['install'] : 0,
					'modules' => isset($php['pear']['modules']) ? $php['pear']['modules'] : [],
				],
				'pecl' => [
					'install' => isset($php['pecl']['install']) ? (int) $php['pecl']['install'] : 0,
					'modules' => isset($php['pecl']['modules']) ? $php['pecl']['modules'] : [],
				],
				'composer' => [
					'install' => isset($php['composer']['install']) ? (int) $php['composer']['install'] : 0,
				],
				'mailcatcher' => [
					'install' => isset($php['mailcatcher']['install']) ? (int) $php['mailcatcher']['install'] : 0,
				],
				'phpmyadmin' => [
					'install' => isset($php['phpmyadmin']['install']) ? (int) $php['phpmyadmin']['install'] : 0,
				],
				'xdebug' => [
					'install' => isset($php['xdebug']['install']) ? (int) $php['xdebug']['install'] : 0,
					'webgrind' => isset($php['xdebug']['webgrind']) ? (int) $php['xdebug']['webgrind'] : 0,
					'settings' => isset($php['xdebug']['settings']) ? $php['xdebug']['settings'] : [],
				],
				'xhprof' => [
					'install' => isset($php['xhprof']['install']) ? (int) $php['xhprof']['install'] : 0,
					'xhgui' => isset($php['xhprof']['xhgui']) ? (int) $php['xhprof']['xhgui'] : 0,
				],
				'ini' => $php['ini'],
				'timezone' => $php['timezone'],
			]
		];
	}

}
