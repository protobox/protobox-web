<?php namespace Protobox\Builder\Sections;

class Devtools extends Section {

	public function defaults()
	{
		return [

			//
			// Local Tunnel
			//
			
			'ngrok_install' => 1,

		];
	}

}