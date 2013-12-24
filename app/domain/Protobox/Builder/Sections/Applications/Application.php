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

}