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

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['repository'])) return [];

		$rules = [];

		foreach((array)$app['repository'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.repository.'.$id.'.name' => 'required',
					'applications.repository.'.$id.'.path' => 'required',
					'applications.repository.'.$id.'.source' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['repository'])) return [];

		$fields = [];

		foreach((array)$app['repository'] as $id => $dat)
		{
			$fields += [
				'applications.repository.'.$id.'.name' => 'Application: Repository #'.($id+1).' Name',
				'applications.repository.'.$id.'.path' => 'Application: Repository #'.($id+1).' Document Root',
				'applications.repository.'.$id.'.source' => 'Application: Repository #'.($id+1).' Repository URL',
				'applications.repository.'.$id.'.revision' => 'Application: Repository #'.($id+1).' Branch',
				'applications.repository.'.$id.'.preinstall' => 'Application: Repository #'.($id+1).' Pre-Install',
				'applications.repository.'.$id.'.postinstall' => 'Application: Repository #'.($id+1).' Post-Install',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['repository'])) return [];

		$app = $output['applications']['repository'];
		$repos = [];

		foreach((array)$app as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'source' => isset($dat['options']['source']) ? $dat['options']['source'] : '',
				'revision' => isset($dat['options']['revision']) ? $dat['options']['revision'] : '',
				'pre_install' => isset($dat['options']['pre_install']) ? $dat['options']['pre_install'] : [],
				'post_install' => isset($dat['options']['post_install']) ? $dat['options']['post_install'] : [],
			];
		}

		return [
			'repository' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['repository'])) return [];

		$repos = [];

		foreach((array)$app['repository'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [
					'provider' => 'git',
					'source' => isset($dat['source']) ? $dat['source'] : '',
					'revision' => isset($dat['revision']) ? $dat['revision'] : '',
					'pre_install' => isset($dat['pre_install']) && count($dat['pre_install']) ? $dat['pre_install'] : '[]',
					'post_install' => isset($dat['post_install']) && count($dat['post_install']) ? $dat['post_install'] : '[]',
				]
			];
		}

		return [
			'repository' => $repos
		];
	}

}