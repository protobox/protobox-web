<?php namespace Protobox\Builder\Sections\Applications;

class Application {

	protected $section = null;

	public function section($section)
	{
		$this->section = $section;
	}

	public function defaults()
	{
		return [];
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

}