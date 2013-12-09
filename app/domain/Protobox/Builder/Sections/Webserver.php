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
			'apache_virtualhosts' => [
				[
					'server_name' => 'app.dev',
					'server_alias' => ['www.app.dev'],
					'document_root' => '/srv/www/app.dev',
					'port' => '80',
					'environment' => ['APP_ENV dev'],
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
					'server_alias' => ['www.app.dev'],
					'document_root' => '/srv/www/app.dev',
					'port' => '80',
					'environment' => ['APP_ENV dev']
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

}