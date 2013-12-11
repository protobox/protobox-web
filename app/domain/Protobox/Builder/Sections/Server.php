<?php namespace Protobox\Builder\Sections;

class Server extends Section {

	public function defaults()
	{
		return [

			//
			// Packages
			//
			
			'packages' => ['vim'],

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
			'dotfiles_git' => [],
			'dotfiles_files' => [],
			'dotfiles_bash' => '',

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

		$dot_git_repos = [
			[
				'repo' => 'git@github.com:patrickheeney/dotfiles.git',
				'path' => '/home/{{ ansible_user_id }}'
			],
			[
				'repo' => 'git@github.com:patrickheeney/dotfiles.git',
				'path' => '/home/{{ ansible_user_id }}/.vimrc'
			]
		];

		$dot_files = [];

		return [
			'server' => [
				'packages' => $server['packages'],
				'ssh' => [
					'authorized_keys' => $ssh_authorized_keys,
					'private_keys' => $ssh_private_keys,
					'config' => $ssh_config
				],
				'dotfiles' => [
					'install' => isset($server['dotfiles']['install']) ? (int) $server['dotfiles']['install'] : 0,
					'git' => $dot_git_repos,
					'files' => $dot_files,
					'bash_aliases' => null
				]
			]
		];
	}

}
