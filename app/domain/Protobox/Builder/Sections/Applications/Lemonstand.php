<?php namespace Protobox\Builder\Sections\Applications;

class Lemonstand extends Application {

	public function defaults()
	{
		return [

			'lemonstand_name' => 'lemonstand-test',
			'lemonstand_install' => 1,
			'lemonstand_path' => '/srv/www/web/lemonstand',

			'lemonstand_holder' => '',
			'lemonstand_serial' => '',
			'lemonstand_dbname' => 'lemonstand',

			'lemonstand_firstname' => 'Admin',
			'lemonstand_lastname' => 'Admin',
			'lemonstand_email' => 'admin@admin.com',
			'lemonstand_username' => 'admin',
			'lemonstand_password' => 'admin',

			'lemonstand_defaulttheme' => 1,
			'lemonstand_defaulttwig' => 1,
			'lemonstand_demodata' => 1,

			'lemonstand_encrypt' => 'encryptionkey',

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['lemonstand'])) return [];

		$rules = [];

		foreach((array)$app['lemonstand'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.lemonstand.'.$id.'.name' => 'required',
					'applications.lemonstand.'.$id.'.path' => 'required',
					'applications.lemonstand.'.$id.'.holder' => 'required',
					'applications.lemonstand.'.$id.'.serial' => 'required',
					'applications.lemonstand.'.$id.'.dbname' => 'required',
					'applications.lemonstand.'.$id.'.firstname' => 'required',
					'applications.lemonstand.'.$id.'.lastname' => 'required',
					'applications.lemonstand.'.$id.'.email' => 'required',
					'applications.lemonstand.'.$id.'.username' => 'required',
					'applications.lemonstand.'.$id.'.password' => 'required',
					'applications.lemonstand.'.$id.'.encrypt' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['lemonstand'])) return [];

		$fields = [];

		foreach((array)$app['lemonstand'] as $id => $dat)
		{
			$fields += [
				'applications.lemonstand.'.$id.'.name' => 'Application: Lemonstand #'.($id+1).' Name',
				'applications.lemonstand.'.$id.'.path' => 'Application: Lemonstand #'.($id+1).' Document Root',
				'applications.lemonstand.'.$id.'.holder' => 'Application: Lemonstand #'.($id+1).' License Holder',
				'applications.lemonstand.'.$id.'.serial' => 'Application: Lemonstand #'.($id+1).' Serial Number',
				'applications.lemonstand.'.$id.'.dbname' => 'Application: Lemonstand #'.($id+1).' Database Name',
				'applications.lemonstand.'.$id.'.firstname' => 'Application: Lemonstand #'.($id+1).' Admin First Name',
				'applications.lemonstand.'.$id.'.lastname' => 'Application: Lemonstand #'.($id+1).' Admin Last Name',
				'applications.lemonstand.'.$id.'.email' => 'Application: Lemonstand #'.($id+1).' Admin Email',
				'applications.lemonstand.'.$id.'.username' => 'Application: Lemonstand #'.($id+1).' Admin Username',
				'applications.lemonstand.'.$id.'.password' => 'Application: Lemonstand #'.($id+1).' Admin Password',
				'applications.lemonstand.'.$id.'.encrypt' => 'Application: Lemonstand #'.($id+1).' Encryption Key',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['lemonstand'])) return [];

		$repos = [];

		foreach((array)$output['applications']['lemonstand'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'holder' => isset($dat['options']['holder']) ? $dat['options']['holder'] : '',
				'serial' => isset($dat['options']['serial']) ? $dat['options']['serial'] : '',
				'dbname' => isset($dat['options']['dbname']) ? $dat['options']['dbname'] : '',
				'firstname' => isset($dat['options']['firstname']) ? $dat['options']['firstname'] : '',
				'lastname' => isset($dat['options']['lastname']) ? $dat['options']['lastname'] : '',
				'email' => isset($dat['options']['email']) ? $dat['options']['email'] : '',
				'username' => isset($dat['options']['username']) ? $dat['options']['username'] : '',
				'password' => isset($dat['options']['password']) ? $dat['options']['password'] : '',
				'defaulttheme' => isset($dat['options']['defaulttheme']) ? (int) $dat['options']['defaulttheme'] : 0,
				'defaulttwig' => isset($dat['options']['defaulttwig']) ? (int) $dat['options']['defaulttwig'] : 0,
				'demodata' => isset($dat['options']['demodata']) ? (int) $dat['options']['demodata'] : 0,
				'encrypt' => isset($dat['options']['encrypt']) ? $dat['options']['encrypt'] : '',
			];
		}

		return [
			'lemonstand' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['lemonstand'])) return [];

		$repos = [];

		foreach((array)$app['lemonstand'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [
					'holder' => isset($dat['holder']) ? $dat['holder'] : '',
					'serial' => isset($dat['serial']) ? $dat['serial'] : '',
					'dbhost' => 'localhost',
					'dbname' => isset($dat['dbname']) ? $dat['dbname'] : '',
					'dbuser' => 'root',
					'dbpass' => 'root',
					'firstname' => isset($dat['firstname']) ? $dat['firstname'] : '',
					'lastname' => isset($dat['lastname']) ? $dat['lastname'] : '',
					'email' => isset($dat['email']) ? $dat['email'] : '',
					'username' => isset($dat['username']) ? $dat['username'] : '',
					'password' => isset($dat['password']) ? $dat['password'] : '',
					'defaulttheme' => isset($dat['defaulttheme']) ? (int) $dat['defaulttheme'] : 0,
					'defaulttwig' => isset($dat['defaulttwig']) ? (int) $dat['defaulttwig'] : 0,
					'demodata' => isset($dat['demodata']) ? (int) $dat['demodata'] : 0,
					'encrypt' => isset($dat['encrypt']) ? $dat['encrypt'] : '',
				]
			];
		}

		return [
			'lemonstand' => $repos
		];
	}

}