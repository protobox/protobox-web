<?php namespace Protobox\Builder\Sections;

class Applications extends Section {

	protected $app = [];

	public function applications()
	{
		return [
			'repository' => 'Git Repoistory (Public or Private)',
			'drupal' => 'Drupal',
			'laravel' => 'Laravel',
			'lemonstand' => 'Lemonstand',
			'sylius' => 'Sylius',
			'symfony' => 'Symfony',
			'wordpress' => 'Wordpress',
		];
	}

	public function init()
	{
		foreach($this->applications() as $app => $name)
		{
			$class_name = 'Protobox\\Builder\\Sections\\Applications\\' . ucwords($app);
			$this->app[$app] = new $class_name;
			$this->app[$app]->section($this);
		}

		parent::init();
	}

	public function defaults()
	{
		$defaults = [

			'applications' => [],

		];

		foreach($this->applications() as $app => $name)
		{
			$defaults += $this->app[$app]->defaults();
		}

		return $defaults;
	}

}