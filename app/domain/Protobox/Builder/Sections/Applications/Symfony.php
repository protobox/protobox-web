<?php namespace Protobox\Builder\Sections\Applications;

class Symfony extends Application {

	public function defaults()
	{
		return [

			'symfony_name' => 'symfony-test',
			'symfony_install' => 1,
			'symfony_path' => '/vagrant/web/symfony',

		];
	}

	public function rules()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['symfony'])) return [];

		$rules = [];

		foreach((array)$app['symfony'] as $id => $dat)
		{
			//if (isset($dat['install']) && (int) $dat['install'] == 1)
			//{
				$rules += [
					'applications.symfony.'.$id.'.name' => 'required',
					'applications.symfony.'.$id.'.path' => 'required',
				];
			//}
		}

		return $rules;
	}

	public function fields()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['symfony'])) return [];

		$fields = [];

		foreach((array)$app['symfony'] as $id => $dat)
		{
			$fields += [
				'applications.symfony.'.$id.'.name' => 'Application: Symfony #'.($id+1).' Name',
				'applications.symfony.'.$id.'.path' => 'Application: Symfony #'.($id+1).' Document Root',
			];
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications']['symfony'])) return [];

		$repos = [];

		foreach((array)$output['applications']['symfony'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [],
			];
		}

		return [
			'symfony' => $repos
		];
	}

	public function output()
	{
		$app = $this->section->getBuilder()->request()->get('applications');

		if ( ! isset($app['symfony'])) return [];

		$repos = [];

		foreach((array)$app['symfony'] as $id => $dat)
		{
			$repos[] = [
				'name' => isset($dat['name']) ? $dat['name'] : '',
				'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
				'path' => isset($dat['path']) ? $dat['path'] : '',
				'options' => [],
			];
		}

		return [
			'symfony' => $repos
		];
	}

}
