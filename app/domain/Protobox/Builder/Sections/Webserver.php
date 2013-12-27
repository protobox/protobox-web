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
					'servername' => 'app.dev',
					'serveraliases' => ['www.app.dev'],
					'docroot' => '/srv/www/app.dev',
					'port' => '80',
					'setenv' => ['APP_ENV dev']
				]
			],

		];
	}

	public function rules()
	{
		$webserver = $this->builder->request()->get('webserver');
		$rules = [];

		if (isset($webserver['apache']['vhosts']))
		{
			foreach((array)$webserver['apache']['vhosts'] as $id => $dat)
			{
				$rules += [
					//'webserver.apache.vhosts.'.$id.'.name' => 'required',
					'webserver.apache.vhosts.'.$id.'.servername' => 'required',
					'webserver.apache.vhosts.'.$id.'.docroot' => 'required',
					'webserver.apache.vhosts.'.$id.'.port' => 'required',
				];
			}
		}

		if (isset($webserver['nginx']['vhosts']))
		{
			foreach((array)$webserver['nginx']['vhosts'] as $id => $dat)
			{
				$rules += [
					//'webserver.nginx.vhosts.'.$id.'.name' => 'required',
					'webserver.nginx.vhosts.'.$id.'.servername' => 'required',
					'webserver.nginx.vhosts.'.$id.'.docroot' => 'required',
					'webserver.nginx.vhosts.'.$id.'.port' => 'required',
				];
			}
		}

		return $rules;
	}

	public function fields()
	{
		$webserver = $this->builder->request()->get('webserver');
		$fields = [];

		if (isset($webserver['apache']['vhosts']))
		{
			foreach((array)$webserver['apache']['vhosts'] as $id => $dat)
			{
				$fields += [
					'webserver.apache.vhosts.'.$id.'.name' => 'Web Server: Apache Virtualhost #'.($id+1).' Name',
					'webserver.apache.vhosts.'.$id.'.servername' => 'Web Server: Apache Virtualhost #'.($id+1).' Server Name',
					'webserver.apache.vhosts.'.$id.'.docroot' => 'Web Server: Apache Virtualhost #'.($id+1).' Document Root',
					'webserver.apache.vhosts.'.$id.'.port' => 'Web Server: Apache Virtualhost #'.($id+1).' Port',
				];
			}
		}

		if (isset($webserver['nginx']['vhosts']))
		{
			foreach((array)$webserver['nginx']['vhosts'] as $id => $dat)
			{
				$fields += [
					'webserver.nginx.vhosts.'.$id.'.name' => 'Web Server: Nginx Virtualhost #'.($id+1).' Name',
					'webserver.nginx.vhosts.'.$id.'.servername' => 'Web Server: Nginx Virtualhost #'.($id+1).' Server Name',
					'webserver.nginx.vhosts.'.$id.'.docroot' => 'Web Server: Nginx Virtualhost #'.($id+1).' Document Root',
					'webserver.nginx.vhosts.'.$id.'.port' => 'Web Server: Nginx Virtualhost #'.($id+1).' Port',
				];
			}
		}

		return $fields;
	}

	public function valid()
	{
		$webserver = $this->builder->request()->get('webserver');

		// Check to see if apache and nginx is installed
		if (
			isset($webserver['apache']['install']) && 
			isset($webserver['nginx']['install']) && 
			(int) $webserver['apache']['install'] == 1 && 
			(int) $webserver['nginx']['install'] == 1
		)
		{
			$this->setError('Web Server: Please choose either apache or nginx for your web server, not both.');

			return false;
		}

		return true;
	}

	public function load($output)
	{
		$apache_vhosts = [];
		if (isset($output['apache']['vhosts']))
		{
			foreach ($output['apache']['vhosts'] as $vhost)
			{
				$apache_vhosts[] = [
					'name' => isset($vhost['name']) ? $vhost['name'] : '',
					'servername' => isset($vhost['servername']) ? $vhost['servername'] : '',
					'serveraliases' => isset($vhost['serveraliases']) ? $vhost['serveraliases'] : [],
					'docroot' => isset($vhost['docroot']) ? $vhost['docroot'] : '',
					'port' => isset($vhost['port']) ? (int) $vhost['port'] : '',
					'setenv' => isset($vhost['setenv']) ? $vhost['setenv'] : [],
					'override' => isset($vhost['override']) ? $vhost['override'] : [],
				];
			}
		}

		$nginx_vhosts = [];
		if (isset($output['nginx']['vhosts']))
		{
			foreach ($output['nginx']['vhosts'] as $vhost)
			{
				$nginx_vhosts[] = [
					'name' => isset($vhost['name']) ? $vhost['name'] : '',
					'servername' => isset($vhost['server_name']) ? $vhost['server_name'] : '',
					'serveraliases' => isset($vhost['server_aliases']) ? $vhost['server_aliases'] : [],
					'docroot' => isset($vhost['www_root']) ? $vhost['www_root'] : '',
					'port' => isset($vhost['listen_port']) ? (int) $vhost['listen_port'] : '',
					'index_files' => isset($vhost['index_files']) ? $vhost['index_files'] : [],
					'setenv' => isset($vhost['envvars']) ? $vhost['envvars'] : [],
				];
			}
		}

		return [
			'apache' => [
				'install' => isset($output['apache']['install']) ? (int) $output['apache']['install'] : 0,
				'modules' => isset($output['apache']['modules']) ? $output['apache']['modules'] : [],
				'vhosts' => $apache_vhosts,
			],

			'nginx' => [
				'install' => isset($output['nginx']['install']) ? (int) $output['nginx']['install'] : 0,
				'vhosts' => $nginx_vhosts,
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
				'setenv' => ['APP_ENV dev'],
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
				'envvars' => ['APP_ENV dev']
			]
		];

		foreach($webserver['apache']['vhosts'] as $vhost)
		{
			$apache_vhosts[] = [
				'name' => 'app',
				'servername' => isset($vhost['servername']) ? $vhost['servername'] : '',
				'serveraliases' => isset($vhost['serveraliases']) ? $vhost['serveraliases'] : [],
				'docroot' => isset($vhost['docroot']) ? $vhost['docroot'] : '',
				'port' => isset($vhost['port']) ? (int) $vhost['port'] : 80,
				'setenv' => isset($vhost['setenv']) ? $vhost['setenv'] : [],
				'override' => isset($vhost['override']) ? $vhost['override'] : []
			];
		}

		foreach($webserver['nginx']['vhosts'] as $vhost)
		{
			$nginx_vhosts[] = [
				'name' => 'app',
				'server_name' => isset($vhost['servername']) ? $vhost['servername'] : '',
				'server_aliases' => isset($vhost['serveraliases']) ? $vhost['serveraliases'] : [],
				'www_root' => isset($vhost['docroot']) ? $vhost['docroot'] : '',
				'listen_port' => isset($vhost['port']) ? (int) $vhost['port'] : 80,
				'index_files' => ['index.html', 'index.htm', 'index.php'],
				'envvars' => isset($vhost['setenv']) ? $vhost['setenv'] : []
			];
		}

		return [
			'apache' => [
				'install' => isset($webserver['apache']['install']) ? (int) $webserver['apache']['install'] : 0,
				'modules' => isset($webserver['apache']['modules']) ? $webserver['apache']['modules'] : '[]',
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