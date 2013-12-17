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
					'label' => 'CentOS 6.4 x64 - VirtualBox 4.3',
					'url' => 'http://box.puphpet.com/centos64-x64-vbox43.box',
					'name' => 'centos64-x64-vbox43-1383512148',
					'php' => '55',
					'php_versions' => ['5.4', '5.5'],
					'selected' => true,
				],
				[
					'label' => 'CentOS 6.4 x64 - Virtualbox 4.2',
					'url' => 'http://box.puphpet.com/centos64-x64-vbox4210.box',
					'name' => 'centos64-x64-vbox4210-1383511158',
					'php' => '55',
					'php_versions' => ['5.4', '5.5'],
				]
			],
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
				'box' => isset($output['vm']['box']) ? $output['vm']['box'] : '',
				'local_name' => isset($output['vm']['hostname']) ? $output['vm']['hostname'] : '',
				'local_ip' => isset($output['vm']['network']['private_network']) ? $output['vm']['network']['private_network'] : '',
				'local_memory' => isset($output['vm']['virtualbox']['virtualbox']['modifyvm']['memory']) ? $output['vm']['virtualbox']['virtualbox']['modifyvm']['memory'] : '',
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
		];
	}

}