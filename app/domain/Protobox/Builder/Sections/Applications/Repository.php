<?php namespace Protobox\Builder\Sections\Applications;

class Repository extends Application {

	public function defaults()
	{
		return [

			'repository_name' => 'repo-test',
			'repository_install' => 1,
			'repository_path' => '/srv/www/web/repo',
			'repository_source' => 'git@github.com:protobox/protobox-web.git',
			'repository_revision' => 'master',
			'repository_pre_install' => [],
			'repository_post_install' => [],

		];
	}

}