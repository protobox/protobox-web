<?php namespace Protobox\Builder\Sections;

class Vagrant extends Section {

	public function machine_types()
	{
		return [
			'local' => 'Local'
		];
	}

	public function defaults()
	{
		return [

			//
			// Local Virtual Machines
			//
			
			'local_vm_os' => [
				[
					'label' => 'Ubuntu 12.04 Precise x64',
					'url' => 'http://files.vagrantup.com/precise64.box',
					'name' => 'precise64',
					'php' => '55',
					'php_versions' => ['5.4', '5.5'],
				],
				[
					'label' => 'Ubuntu 10.04 Lucid x64',
					'url' => 'http://files.vagrantup.com/lucid64.box',
					'name' => 'lucid64',
					'php' => '55',
					'php_versions' => ['5.4', '5.5'],
				]
			],
			'local_vm_os_url' => 'http://files.vagrantup.com/precise64.box',
			'local_vm_os_name' => 'precise64',
			'local_vm_name' => 'protobox',
			'local_vm_ip' => '192.168.5.10',
			'local_vm_memory' => '512',
			
		];
	}

	public function rules()
	{
		$rules = [
			'vagrant.box' => 'required',
			'vagrant.box_url' => 'required',
		];

		/* 
		$vagrant = $this->builder->request()->get('vagrant');
		if ($vagrant['deploy'] == 'local')
		{
			$rules += [

			];
		}*/

		$rules += [
			'vagrant.local_name' => 'required',
			'vagrant.local_ip' => 'required',
			'vagrant.local_memory' => 'required',
		];

		return $rules;
	}

	public function fields()
	{
		return [
			'vagrant.box' => 'Vagrant Operating System Box',
			'vagrant.box_url' => 'Vagrant Operating System Box URL',

			'vagrant.local_name' => 'Vagrant Local VM Name',
			'vagrant.local_ip' => 'Vagrant Local IP',
			'vagrant.local_memory' => 'Vagrant Local Memory',
		];
	}

	public function load($output)
	{
		return [
			'vagrant' => [
				'box' => isset($output['vagrant']['vm']['box']) ? $output['vagrant']['vm']['box'] : '',
				'box_url' => isset($output['vagrant']['vm']['box_url']) ? $output['vagrant']['vm']['box_url'] : '',
				'local_name' => isset($output['vagrant']['vm']['hostname']) ? $output['vagrant']['vm']['hostname'] : '',
				'local_ip' => isset($output['vagrant']['vm']['network']['private_network']) ? $output['vagrant']['vm']['network']['private_network'] : '',
				'local_memory' => isset($output['vagrant']['vm']['provider']['virtualbox']['modifyvm']['memory']) ? $output['vagrant']['vm']['provider']['virtualbox']['modifyvm']['memory'] : '',
			]
		];
	}

	public function output()
	{
		$vagrant = $this->builder->request()->get('vagrant');

		$ports = [
			'port1' => ['host' => '', 'guest' => '']
		];

		$folders = [
			'root' => [
				'id' => 'vagrant-root',
				'source' => './',
				'target' => '/srv/www/',
				'nfs' => false,
				'owner' => 'vagrant',
				'group' => 'www-data',
				'mount_options' => ['dmode=775', 'fmode=775']
			]
		];

		return [
			'vagrant' => [
				'vm' => [
					'box' => $vagrant['box'],
					'box_url' => $vagrant['box_url'],
					'hostname' => $vagrant['local_name'],
					'network' => [
						'private_network' => $vagrant['local_ip'],
						'forwarded_port' => $ports
					],
					'provider' => [
						'virtualbox' => [
							'modifyvm' => [
								'name' => $vagrant['local_name'],
								'natdnshostresolver1' => 'on',
								'memory' => $vagrant['local_memory']
							],
							'setextradata' => [
								'VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root' => 1
							]
						]
					],
					'provision' => [
						'ansible' => [
							'playbook' => 'ansible/site.yml'
						]
					],
					'synced_folder' => $folders,
					'usable_port_range' => '2200..2250'
				],
				'ssh' => [
					'host' => null,
					'port' => null,
					'private_key_path' => null,
					'public_key_path' => null,
					'username' => 'vagrant',
					'guest_port' => null,
					'keep_alive' => true,
					'forward_agent' => false,
					'forward_x11' => false,
					'shell' => 'bash -l'
				],
				'vagrant' => [
					'host' => ':detect'
				]
			]
		];
	}

}