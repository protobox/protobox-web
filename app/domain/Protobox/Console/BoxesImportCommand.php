<?php namespace Protobox\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Protobox\Explore\BoxRepositoryInterface;
use Symfony\Component\Yaml\Yaml;
use File;
use App;

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
		$path = storage_path().'/boxes/';
		$files = File::allFiles($path);

		foreach($files as $file)
		{
			$filepath = str_replace($path, '', $file);

			if ($filepath == 'README.md') continue;

			$id = str_replace(['/', '.yml'], ['_', ''], $filepath);
			$content = File::get($file);
			$data = Yaml::parse($content);

			$document = $data['protobox']['document'];
			$box = $this->box->getByDocument($document);

			if ($box)
			{
				$box->update([
					'name' => isset($data['protobox']['name']) ? $data['protobox']['name'] : 'NoName',
					'description' => isset($data['protobox']['description']) ? $data['protobox']['description'] : '',
					'code' => $content
				]);

				$box->save();
			}
			else
			{
				$box = $this->box->create([
					'document' => $document,
					'name' => isset($data['protobox']['name']) ? $data['protobox']['name'] : 'NoName',
					'description' => isset($data['protobox']['description']) ? $data['protobox']['description'] : '',
					'code' => $content
				]);

				$box->document = $document;

				$box->save();
			}

			$this->info($id);
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