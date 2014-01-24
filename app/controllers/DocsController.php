<?php

class DocsController extends BaseController
{

	private $homepage = 'introduction';

	public function index($path = null)
	{
		$storage = rtrim(storage_path('docs'), '/');
		$fullpath = rtrim($path, '/');
		$urlparts = explode('/', $fullpath);
		$location = count($urlparts) > 1 ? $storage . '/' . implode('/', array_slice($urlparts, 0, -1)) . '/' : $storage . '/';
		$page = ! $path ? $this->homepage : last($urlparts);
		$file = $location.$page.'.md';

		if ( ! File::exists($file)) App::abort(404);

		$menu = File::get($storage.'/menu.md');
		$content = File::get($file);

		$markdown = Parsedown::instance();

		$data = [
			'menu' => $markdown->parse($this->urls($menu)),
			'page' => $markdown->parse($this->urls($content))
		];

		return View::make('pages.docs.index', $data);
	}

	private function urls($content)
	{
		$content = str_replace('('.$this->homepage.'.md)', '(/docs/)', $content);

		return preg_replace('#\(([a-zA-Z0-9_/]*)\.md\)#', '(/docs/\\1/)', $content);
	}

}