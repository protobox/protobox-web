<?php namespace Protobox\Builder\Sections;

class Server extends Section {

	public function defaults()
	{
		return [

			//
			// Packages
			//
			
			'packages' => [],

			//
			// SSH
			//
			
			'ssh_authorized_keys' => [],
			'ssh_private_keys' => [],
			'ssh_config' => [],

			//
			// Dotfiles
			//
			
			'dotfiles_install' => 0,
			'dotfiles_repo' => '',
			'dotfiles_files' => [],
			'dotfiles_bash' => '',

		];
	}

	public function load($output)
	{
		return [
			'server' => [
				'packages' => isset($output['server']['packages']) ? $output['server']['packages'] : [],
				'dotfiles' => [
					'install' => isset($output['server']['dotfiles']['install']) ? (int) $output['server']['dotfiles']['install'] : 0,
					'repo' => isset($output['server']['dotfiles']['repo']) ? $output['server']['dotfiles']['repo'] : '',
				]
			]
		];
	}

	public function output()
	{
		$server = $this->builder->request()->get('server');

		$ssh_authorized_keys = [
			[
				'name' => 'user1',
				'file' => '/srv/www/data/ssh/github_id_rsa'
			],
			[
				'name' => 'user2',
				'entry' => '123'
			]
		];

		$ssh_private_keys = [
			[
				'name' => 'github',
				'file' => '/srv/www/data/ssh/github_id_rsa'
			],
			[
				'name' => 'github',
				'entry' => 'test\n\ttest2'
			]
		];

		$ssh_config = [
			[
				'name' => 'github',
				'file' => '/srv/www/data/ssh/git_config'
			],
			[
				'name' => 'github',
				'entry' => 'host *\n\tIdentityFile ~/.ssh/github_id_rsa'
			]
		];

		$dot_files = [];

		return [
			'server' => [
				'packages' => isset($server['packages']) && count($server['packages']) ? $server['packages'] : '[]',
				'ssh' => [
					'authorized_keys' => [],
					'private_keys' => [],
					'config' => []
				],
				'dotfiles' => [
					'install' => isset($server['dotfiles']['install']) ? (int) $server['dotfiles']['install'] : 0,
					'repo' => isset($server['dotfiles']['repo']) ? $server['dotfiles']['repo'] : '',
					'files' => $dot_files,
					'bash_aliases' => null
				]
			]
		];
	}

}
