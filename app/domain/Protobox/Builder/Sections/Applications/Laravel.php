<?php namespace Protobox\Builder\Sections\Applications;

class Laravel extends Application {

	public function defaults()
	{
		return [

			'laravel_name' => 'laravel-test',
			'laravel_install' => 1,
			'laravel_path' => '/srv/www/web/laravel',

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['laravel'])) return [];

		$rules = [];

		foreach((array)$app['laravel'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.laravel.'.$id.'.name' => 'required',
					'applications.laravel.'.$id.'.path' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['laravel'])) return [];

		$fields = [];

		foreach((array)$app['laravel'] as $id => $dat)
		{
			$fields += [
				'applications.laravel.'.$id.'.name' => 'Application: laravel #'.($id+1).' Name',
				'applications.laravel.'.$id.'.path' => 'Application: laravel #'.($id+1).' Document Root',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['laravel'])) return [];

		$repos = [];

		foreach((array)$output['applications']['laravel'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
			];
		}

		return [
			'laravel' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['laravel'])) return [];

		$repos = [];

		foreach((array)$app['laravel'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
			];
		}

		return [
			'laravel' => $repos
		];
	}

}