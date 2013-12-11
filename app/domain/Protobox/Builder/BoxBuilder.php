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
		'vagrant',
		'server',
		'webserver',
		'php',
		'datastore',
		'queues',
		'devtools',
		'applications'
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
		foreach($this->sections as $section)
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

	public function valid()
	{
		// Custom validation
		$valid = true;

		foreach($this->store as $section)
		{
			if ( ! $section->valid())
			{
				$this->errors = $section->errors();
				break;
			}
		}

		if ( ! $valid) return false;

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

	public function output()
	{
		$code = $this->prepare();

		foreach($this->store as $section)
		{
			$code += $section->output();
		}

		return Yaml::dump($code, 100, 2);
	}

	private function prepare()
	{
		return [
			'protobox' => [
				'version' => Config::get('protobox.version'),
				'document' => 'abc123'
			]
		];
	}

}