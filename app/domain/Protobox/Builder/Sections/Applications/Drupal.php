<?php namespace Protobox\Builder\Sections\Applications;

class Drupal extends Application {

	public function defaults()
	{
		return [

			'drupal_name' => 'drupal-test',
			'drupal_install' => 1,
			'drupal_path' => '/srv/www/web/drupal',
			'drupal_version' => '7.0',
			'drupal_dbname' => 'drupal',
			'drupal_user_email' => 'admin@admin.com',
			'drupal_user_name' => 'admin',
			'drupal_user_pass' => 'admin',
			'drupal_modules' => [
				'ctools',
				'wysiwyg'
			]

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['drupal'])) return [];

		$rules = [];

		foreach((array)$app['drupal'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.drupal.'.$id.'.name' => 'required',
					'applications.drupal.'.$id.'.path' => 'required',
					'applications.drupal.'.$id.'.dbname' => 'required',
					'applications.drupal.'.$id.'.drupalversion' => 'required',
					'applications.drupal.'.$id.'.useremail' => 'required',
					'applications.drupal.'.$id.'.username' => 'required',
					'applications.drupal.'.$id.'.userpass' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['drupal'])) return [];

		$fields = [];

		foreach((array)$app['drupal'] as $id => $dat)
		{
			$fields += [
				'applications.drupal.'.$id.'.name' => 'Application: Drupal #'.($id+1).' Name',
				'applications.drupal.'.$id.'.path' => 'Application: Drupal #'.($id+1).' Document Root',
				'applications.drupal.'.$id.'.dbname' => 'Application: Drupal #'.($id+1).' Database Name',
				'applications.drupal.'.$id.'.drupalversion' => 'Application: Drupal #'.($id+1).' Drupal Version',
				'applications.drupal.'.$id.'.useremail' => 'Application: Drupal #'.($id+1).' Admin Email',
				'applications.drupal.'.$id.'.username' => 'Application: Drupal #'.($id+1).' Admin Name',
				'applications.drupal.'.$id.'.userpass' => 'Application: Drupal #'.($id+1).' Admin Password',
				'applications.drupal.'.$id.'.modules' => 'Application: Drupal #'.($id+1).' Modules',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['drupal'])) return [];

		$app = $output['applications']['drupal'];
		$repos = [];

		foreach((array)$app as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'dbname' => isset($dat['options']['dbname']) ? $dat['options']['dbname'] : '',
				'drupalversion' => isset($dat['options']['drupal_version']) ? $dat['options']['drupal_version'] : '',
				'useremail' => isset($dat['options']['user_email']) ? $dat['options']['user_email'] : '',
				'username' => isset($dat['options']['user_name']) ? $dat['options']['user_name'] : '',
				'userpass' => isset($dat['options']['user_password']) ? $dat['options']['user_password'] : '',
				'modules' => isset($dat['options']['modules']) ? $dat['options']['modules'] : [],
			];
		}

		return [
			'drupal' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['drupal'])) return [];

		$repos = [];

		foreach((array)$app['drupal'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [
					'drush_version' => '',
					'drupal_version' => isset($dat['drupalversion']) ? $dat['drupalversion'] : '',
					'download_args' => '',
					'install_args' => '',
					'dbhost' => 'localhost',
					'dbname' => isset($dat['dbname']) ? $dat['dbname'] : '',
					'dbuser' => 'root',
					'dbpass' => 'root',
					'user_email' => isset($dat['useremail']) ? $dat['useremail'] : '',
					'user_name' => isset($dat['username']) ? $dat['username'] : '',
					'user_password' => isset($dat['userpass']) ? $dat['userpass'] : '',
					'modules' => isset($dat['modules']) ? $dat['modules'] : [],
				]
			];
		}

		return [
			'drupal' => $repos
		];
	}

}