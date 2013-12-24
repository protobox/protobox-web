<?php namespace Protobox\Builder\Sections;

class Webserver extends Section {

	public function webservers()
	{
		return [
			'apache' => 'Apache',
			'nginx' => 'Nginx'
		];
	}

	public function defaults()
	{
		return [

			//
			// Apache
			//
			
			'apache_install' => 1,
			'apache_modules' => ['rewrite'],
			'apache_modules_available' => $this->apache_modules_available(),
			'apache_virtualhosts' => [
				[
					'servername' => 'app.dev',
					'serveraliases' => ['www.app.dev'],
					'docroot' => '/srv/www/app.dev',
					'port' => '80',
					'setenv' => ['APP_ENV dev'],
					'override' => ['All']
				]
			],

			//
			// Nginx
			//
			
			'nginx_install' => 0,
			'nginx_virtualhosts' => [
				[
					'server_name' => 'app.dev',
					'server_aliases' => ['www.app.dev'],
					'docroot' => '/srv/www/app.dev',
					'port' => '80',
					'setenv' => ['APP_ENV dev']
				]
			],

		];
	}

	public function valid()
	{
		$webserver = $this->builder->request()->get('webserver');

		// Check to see if apache and nginx is installed
		if (
			isset($webserver['apache']) && 
			isset($webserver['nginx']) && 
			isset($webserver['apache']['install']) && 
			isset($webserver['nginx']['install']) && 
			(int) $webserver['apache']['install'] == 1 && 
			(int) $webserver['nginx']['install'] == 1
		)
		{
			$this->setError('Please choose either apache or nginx for your web server, not both.');

			return false;
		}

		return true;
	}

	public function load($output)
	{
		return [
			'apache' => [
				'install' => isset($output['apache']['install']) ? $output['apache']['install'] : 0,
				'modules' => isset($output['apache']['modules']) ? $output['apache']['modules'] : [],
				'vhosts' => isset($output['apache']['vhosts']) ? $output['apache']['vhosts'] : [],
			],

			'nginx' => [
				'install' => isset($output['nginx']['install']) ? $output['nginx']['install'] : 0,
				'vhosts' => isset($output['nginx']['vhosts']) ? $output['nginx']['vhosts'] : [],
			]
		];
	}

	public function output()
	{
		$webserver = $this->builder->request()->get('webserver');

        $apache_vhosts = [
			[
				'name' => 'protobox',
				'servername' => 'protobox.dev',
				'serveraliases' => ['www.protobox.dev'],
				'docroot' => '/srv/www/web/protobox',
				'port' => 80,
				'setenv' => ['APP_ENV' => 'dev'],
				'override' => ['All']
			]
        ];

        $nginx_vhosts = [
			[
				'name' => 'protobox',
				'server_name' => 'protobox.dev',
				'server_aliases' => ['www.protobox.dev'],
				'www_root' => '/srv/www/web/protobox',
				'listen_port' => 80,
				'index_files' => ['index.html', 'index.htm', 'index.php'],
				'envvars' => ['APP_ENV' => 'dev']
			]
        ];

		foreach($webserver['apache']['vhosts'] as $vhost)
		{
			$apache_vhosts[] = [
				'name' => 'app',
				'servername' => $vhost['servername'],
				'serveraliases' => $vhost['serveraliases'],
				'docroot' => $vhost['docroot'],
				'port' => $vhost['port'],
				'setenv' => $vhost['setenv'],
				'override' => $vhost['override']
			];
		}

		foreach($webserver['nginx']['vhosts'] as $vhost)
		{
			$nginx_vhosts[] = [
				'name' => 'app',
				'server_name' => $vhost['servername'],
				'server_aliases' => $vhost['serveraliases'],
				'www_root' => $vhost['docroot'],
				'listen_port' => $vhost['port'],
				'index_files' => ['index.html', 'index.htm', 'index.php'],
				'envvars' => $vhost['setenv']
			];
		}

		return [
			'apache' => [
				'install' => isset($webserver['apache']['install']) ? (int) $webserver['apache']['install'] : 0,
				'modules' => $webserver['apache']['modules'],
				'user' => 'vagrant',
				'group' => 'www-data',
				'default_vhost' => false,
				'mpm_module' => 'prefork',
				'vhosts' => $apache_vhosts
			],
			'nginx' => [
				'install' => isset($webserver['nginx']['install']) ? (int) $webserver['nginx']['install'] : 0,
				'mpm_module' => 'fpm',
				'vhosts' => $nginx_vhosts
			]
		];
	}

	//
	// Apache
	//

	private function apache_modules_available()
	{
		return [
			'cache',
			'cgid',
			'dav',
			'dav_fs',
			'disk_cache',
			'expires',
			'headers',
			'info',
			'ldap',
			'mime_magic',
			'php',
			'proxy_ajp',
			'proxy_balancer',
			'proxy',
			'rewrite',
			'ssl',
			'userdir',
			'vhost_alias',
		];
	}

}