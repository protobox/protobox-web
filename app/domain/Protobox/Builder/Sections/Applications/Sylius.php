<?php namespace Protobox\Builder\Sections\Applications;

class Sylius extends Application {

	public function defaults()
	{
		return [

			'sylius_name' => 'sylius-test',
			'sylius_install' => 1,
			'sylius_path' => '/srv/www/web/sylius',

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['sylius'])) return [];

		$rules = [];

		foreach((array)$app['sylius'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.sylius.'.$id.'.name' => 'required',
					'applications.sylius.'.$id.'.path' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['sylius'])) return [];

		$fields = [];

		foreach((array)$app['sylius'] as $id => $dat)
		{
			$fields += [
				'applications.sylius.'.$id.'.name' => 'Application: Sylius #'.($id+1).' Name',
				'applications.sylius.'.$id.'.path' => 'Application: Sylius #'.($id+1).' Document Root',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['sylius'])) return [];

		$repos = [];

		foreach((array)$output['applications']['sylius'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
			];
		}

		return [
			'sylius' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['sylius'])) return [];

		$repos = [];

		foreach((array)$app['sylius'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
			];
		}

		return [
			'sylius' => $repos
		];
	}

}