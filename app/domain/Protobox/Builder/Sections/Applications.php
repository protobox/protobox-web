<?php namespace Protobox\Builder\Sections;

class Applications extends Section {

	protected $app = [];

	public function applications()
	{
		return [
			'repository' => 'Git Repository (Public or Private)',
			'drupal' => 'Drupal',
			'laravel' => 'Laravel',
			'lemonstand' => 'Lemonstand',
			'pyrocms' => 'PyroCMS',
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

	public function rules()
	{
		$rules = [];

		foreach($this->applications() as $app => $name)
		{
			$rules += $this->app[$app]->rules();
		}

		return $rules;
	}

	public function fields()
	{
		$fields = [];

		foreach($this->applications() as $app => $name)
		{
			$fields += $this->app[$app]->fields();
		}

		return $fields;
	}

	public function load($output)
	{
		if ( ! isset($output['applications'])) return [];

		$out = [];

		foreach($this->applications() as $app => $name)
		{
			$out += $this->app[$app]->load($output);
		}

		if (empty($out)) return $output;

		return [
			'applications' => $out
		];
	}

	public function output($options = [])
	{
		$output = [];

		foreach($this->applications() as $app => $name)
		{
			$output += $this->app[$app]->output();
		}

		if (empty($output)) return $output;

		return [
			'applications' => array_merge([
				'install' => 1
			], $output)
		];
	}

	public function valid()
	{
		foreach($this->applications() as $app => $name)
		{
			if ( ! $this->app[$app]->valid())
				return false;
		}

		return true;
	}

}
