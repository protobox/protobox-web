<?php namespace Protobox\Builder\Sections\Applications;

class Wordpress extends Application {

	public function defaults()
	{
		return [

			'wordpress_name' => 'wordpress-test',
			'wordpress_install' => 1,
			'wordpress_path' => '/srv/www/web/wordpress',
			'wordpress_version' => '3.8',
			'wordpress_dbname' => 'wordpress',

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['wordpress'])) return [];

		$rules = [];

		foreach((array)$app['wordpress'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.wordpress.'.$id.'.name' => 'required',
					'applications.wordpress.'.$id.'.path' => 'required',
					'applications.wordpress.'.$id.'.version' => 'required',
					'applications.wordpress.'.$id.'.dbname' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['wordpress'])) return [];

		$fields = [];

		foreach((array)$app['wordpress'] as $id => $dat)
		{
			$fields += [
				'applications.wordpress.'.$id.'.name' => 'Application: Wordpress #'.($id+1).' Name',
				'applications.wordpress.'.$id.'.path' => 'Application: Wordpress #'.($id+1).' Document Root',
				'applications.wordpress.'.$id.'.version' => 'Application: Wordpress #'.($id+1).' Version',
				'applications.wordpress.'.$id.'.dbname' => 'Application: Wordpress #'.($id+1).' Database Name',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['wordpress'])) return [];

		$repos = [];

		foreach((array)$output['applications']['wordpress'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'dbname' => isset($dat['options']['dbname']) ? $dat['options']['dbname'] : '',
				'version' => isset($dat['options']['version']) ? $dat['options']['version'] : '',
			];
		}

		return [
			'wordpress' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['wordpress'])) return [];

		$repos = [];

		foreach((array)$app['wordpress'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [
					'method' => 'zip',
					'version' => isset($dat['version']) ? $dat['version'] : '',
					'dbhost' => 'localhost',
					'dbname' => isset($dat['dbname']) ? $dat['dbname'] : '',
					'dbuser' => 'root',
					'dbpass' => 'root',
				]
			];
		}

		return [
			'wordpress' => $repos
		];
	}

}