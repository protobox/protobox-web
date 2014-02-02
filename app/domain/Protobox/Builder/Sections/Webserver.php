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

			'apache_virtualhost_servername' => 'app.dev',
			'apache_virtualhost_serveraliases' => ['www.app.dev'],
			'apache_virtualhost_docroot' => '/srv/www/web/protobox',
			'apache_virtualhost_port' => '80',
			'apache_virtualhost_setenv' => [],
			'apache_virtualhost_override' => ['All'],

			'apache_virtualhosts' => [
				[
					'servername' => 'app.dev',
					'serveraliases' => ['www.app.dev'],
					'docroot' => '/srv/www/web/protobox',
					'port' => '80',
					'setenv' => ['APP_ENV dev'],
					'override' => ['All']
				]
			],

			//
			// Nginx
			//
			
			'nginx_install' => 0,

			'nginx_virtualhost_servername' => 'app.dev',
			'nginx_virtualhost_serveraliases' => ['www.app.dev'],
			'nginx_virtualhost_docroot' => '/srv/www/web/protobox',
			'nginx_virtualhost_port' => '80',
			'nginx_virtualhost_setenv' => [],

			'nginx_virtualhosts' => [
				[
					'servername' => 'app.dev',
					'serveraliases' => ['www.app.dev'],
					'docroot' => '/srv/www/web/protobox',
					'port' => '80',
					'setenv' => ['APP_ENV dev']
				]
			],

		];
	}

	public function rules()
	{
		$apache = $this->builder->request()->get('apache');
		$nginx = $this->builder->request()->get('nginx');
		$rules = [];

		if (isset($apache['vhosts']))
		{
			foreach((array)$apache['vhosts'] as $id => $dat)
			{
				$rules += [
					//'apache.vhosts.'.$id.'.name' => 'required',
					'apache.vhosts.'.$id.'.servername' => 'required',
					'apache.vhosts.'.$id.'.docroot' => 'required',
					'apache.vhosts.'.$id.'.port' => 'required',
				];
			}
		}

		if (isset($nginx['vhosts']))
		{
			foreach((array)$nginx['vhosts'] as $id => $dat)
			{
				$rules += [
					//'nginx.vhosts.'.$id.'.name' => 'required',
					'nginx.vhosts.'.$id.'.servername' => 'required',
					'nginx.vhosts.'.$id.'.docroot' => 'required',
					'nginx.vhosts.'.$id.'.port' => 'required',
				];
			}
		}

		return $rules;
	}

	public function fields()
	{
		$apache = $this->builder->request()->get('apache');
		$nginx = $this->builder->request()->get('nginx');
		$fields = [];
		
		if (isset($apache['vhosts']))
		{
			foreach((array)$apache['vhosts'] as $id => $dat)
			{
				$fields += [
					'apache.vhosts.'.$id.'.name' => 'Web Server: Apache Virtualhost #'.($id+1).' Name',
					'apache.vhosts.'.$id.'.servername' => 'Web Server: Apache Virtualhost #'.($id+1).' Server Name',
					'apache.vhosts.'.$id.'.docroot' => 'Web Server: Apache Virtualhost #'.($id+1).' Document Root',
					'apache.vhosts.'.$id.'.port' => 'Web Server: Apache Virtualhost #'.($id+1).' Port',
				];
			}
		}

		if (isset($nginx['vhosts']))
		{
			foreach((array)$nginx['vhosts'] as $id => $dat)
			{
				$fields += [
					'nginx.vhosts.'.$id.'.name' => 'Web Server: Nginx Virtualhost #'.($id+1).' Name',
					'nginx.vhosts.'.$id.'.servername' => 'Web Server: Nginx Virtualhost #'.($id+1).' Server Name',
					'nginx.vhosts.'.$id.'.docroot' => 'Web Server: Nginx Virtualhost #'.($id+1).' Document Root',
					'nginx.vhosts.'.$id.'.port' => 'Web Server: Nginx Virtualhost #'.($id+1).' Port',
				];
			}
		}

		return $fields;
	}

	public function valid()
	{
		$apache = $this->builder->request()->get('apache');
		$nginx = $this->builder->request()->get('nginx');

		// Check to see if apache and nginx is installed
		if (
			isset($apache['install']) && 
			isset($nginx['install']) && 
			(int) $apache['install'] == 1 && 
			(int) $nginx['install'] == 1
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
			foreach ($output['apache']['vhosts'] as $vhostid => $vhost)
			{
				$name = isset($vhost['name']) ? $vhost['name'] : '';

				$apache_vhosts[] = [
					'name' => $name,
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
			foreach ($output['nginx']['vhosts'] as $vhostid => $vhost)
			{
				$name = isset($vhost['name']) ? $vhost['name'] : '';

				$nginx_vhosts[] = [
					'name' => $name,
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
		$apache = $this->builder->request()->get('apache');
		$nginx = $this->builder->request()->get('nginx');

		$apache_vhosts = [];
		foreach($apache['vhosts'] as $vhostid => $vhost)
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

		$nginx_vhosts = [];
		foreach($nginx['vhosts'] as $vhostid => $vhost)
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
				'install' => isset($apache['install']) ? (int) $apache['install'] : 0,
				'modules' => isset($apache['modules']) && count($apache['modules']) ? $apache['modules'] : '[]',
				'user' => 'vagrant',
				'group' => 'www-data',
				'default_vhost' => false,
				'mpm_module' => 'prefork',
				'vhosts' => $apache_vhosts
			],
			'nginx' => [
				'install' => isset($nginx['install']) ? (int) $nginx['install'] : 0,
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