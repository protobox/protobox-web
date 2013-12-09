<?php namespace Protobox\Builder\Sections;

class Section {

	protected $builder;
	protected $params;
	protected $errors;

	public function __construct()
	{
		$this->params = $this->defaults();
	}

	public function defaults()
	{
		return [];
	}

	public function builder($builder = null)
	{
		$this->builder = $builder;
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