<?php namespace Protobox\Builder\Sections;

use Symfony\Component\Yaml\Parser;

class Section {

	protected $builder;
	protected $params;
	protected $errors;
	protected $parser;
	
	public function init()
	{
		$this->parser = new Parser();
		$this->params = $this->defaults();
	}

	public function builder($builder = null)
	{
		$this->builder = $builder;
	}

	public function getBuilder()
	{
		return $this->builder;
	}

	public function defaults()
	{
		return [];
	}

	public function param($key, $default = null)
	{
		return isset($this->params[$key]) ? $this->params[$key] : $default;
	}

	public function rules()
	{
		return [];
	}

	public function fields()
	{
		return [];
	}

	public function load($output)
	{
		return [];
	}

	public function output()
	{
		return [];
	}

	public function valid()
	{
		return true;
	}

	public function errors()
	{
		return $this->errors;
	}

	public function setError($error)
	{
		if ( ! $this->errors) $this->errors = [];

		$this->errors[] = $error;
	}

}