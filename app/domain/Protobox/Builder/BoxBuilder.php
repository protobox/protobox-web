<?php namespace Protobox\Builder;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;
use Config;

class BoxBuilder {

	protected $request;

	protected $validator;

	protected $files;

	protected $validation;

	protected $sections = [
		'applications',
		'vagrant',
		'server',
		'webserver',
		'languages',
		'datastore',
		'queues',
		'tools'
	];

	protected $store = [];

	protected $errors = [];

	public function __construct(Request $request = null,  Validator $validator = null, Filesystem $files = null)
	{
		$this->request = $request;
		$this->validator = $validator;
		$this->files = $files;
	}

	public function request()
	{
		return $this->request;
	}

	public function validator()
	{
		return $this->validator;
	}

	public function files()
	{
		return $this->files;
	}

	public function build()
	{
		$sections = array_merge(['protobox'], $this->sections);

		foreach($sections as $section)
		{
			$class_name = 'Protobox\\Builder\\Sections\\' . ucwords($section);
			$class = new $class_name;
			$class->builder($this);
			$class->init();

			$this->store[$section] = $class;
		}

		return $this;
	}

	public function sections()
	{
		return $this->sections;
	}

	public function section($section)
	{
		return isset($this->store[$section]) ? $this->store[$section] : null;
	}

	public function next_section($section)
	{
		$check = strtolower($section);
		$values = array_flip($this->sections);
		$new_id = isset($values[$check]) ? $values[$check] + 1 : null;

		return $new_id && isset($this->sections[$new_id]) ? $this->sections[$new_id] : 'build';
	}

	public function valid()
	{
		// Custom validation
		foreach($this->store as $section)
		{
			if ( ! $section->valid())
			{
				$this->errors = $section->errors();

				return false;
			}
		}

		// Validate all the fields
		$rules = $names = [];

		foreach($this->store as $section)
		{
			$rules += $section->rules();

			$names += $section->fields();
		}

		$this->validation = $this->validator->make($this->request->all(), $rules);

		$this->validation->setAttributeNames($names);
		
		return $this->validation->passes();
	}

	public function errors()
	{
		return $this->errors ?: $this->validation->errors();
	}

	public function load($data)
	{
		$code = [];
		$output = Yaml::parse($data);

		foreach($this->store as $section)
		{
			$code += $section->load($output);
		}
		
		return $code;
	}

	public function output($options = [])
	{
		$code = [];

		foreach($this->store as $section)
		{
			$code += $section->output($options);
		}

		return Yaml::dump($code, 100, 2);
	}

}