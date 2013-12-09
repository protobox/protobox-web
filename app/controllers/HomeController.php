<?php

class HomeController extends BaseController {

	public function index()
	{
		return View::make('pages.home.index');
	}

	public function about()
	{
		return View::make('pages.about.index');
	}

}