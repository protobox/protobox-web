<?php namespace Protobox\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Protobox\Explore\BoxRepositoryInterface;
use File;

class BoxesImportCommand extends Command {

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

	protected $box;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(BoxRepositoryInterface $box)
	{
		parent::__construct();

		$this->box = $box;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		dd($this->box);

		$path = storage_path().'/boxes/';
		$files = File::allFiles($path);

		foreach($files as $file)
		{
			$filepath = str_replace($path, '', $file);

			if ($filepath == 'README.md') continue;

			$id = str_replace(['/', '.yml'], ['_', ''], $filepath);
			$content = File::get($file);

			$builder = App::make('boxbuilder');
			$data = $builder->load($content);

			$box = $this->box->findById($id);

			if ( ! $box)
			{
				$box = $this->box->create([
					'name' => $data['protobox']['name'],
					'description' => $data['protobox']['description'],
					'code' => $content
				]);
			}
			else
			{
				$this->box->update([

				]);
			}
			
			$this->info($filepath.' - '.$id);
		}

		$this->info('Done');
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