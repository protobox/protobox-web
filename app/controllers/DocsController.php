<?php

class DocsController extends BaseController {

	public function index($path = null)
	{
		$storage = rtrim(storage_path('docs'), '/');
		$location = $storage . '/' . rtrim($path, '/') . '/';
		$page = ! $path ? 'introduction' : head(explode('/', $path));
		$file = $location.$page.'.md';
		
		if ( ! File::exists($file)) App::abort(404);

		$menu = File::get($storage.'/menu.md');
		$content = File::get($file);

		$markdown = Parsedown::instance();

		$data = [
			'menu' => $markdown->parse($menu),
			'page' => $markdown->parse($content)
		];

		return View::make('pages.docs.index', $data);
	}

}