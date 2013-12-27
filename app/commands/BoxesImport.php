<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Protobox\Builder\EloquentBoxRepository as Box;

class BoxesImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'boxes:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Imports boxes from filesystem';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$files = File::allFiles(storage_path().'/boxes');
		$model = new Box;

		foreach($files as $file)
		{
			dd($file);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];

		//return array(
		//	array('example', InputArgument::REQUIRED, 'An example argument.'),
		//);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];

		//return array(
		//	array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		//);
	}

}