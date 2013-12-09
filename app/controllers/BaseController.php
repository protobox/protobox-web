<?php

use Illuminate\Support\MessageBag;

class BaseController extends Controller {

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function isPjax()
	{
		return Request::header('x-eldarion-ajax');
	}

	protected function pjaxPage($content)
	{
		return Response::json(['html' => (string) $content]);
	}

	protected function pjaxFragment(array $fragments)
	{
		$keys = [];

		foreach ($fragments as $frag_id => $fragment)
		{
			$keys[strtolower($frag_id)] = (string) $fragment;
		}

		return Response::json($keys);
	}

	protected function pjaxError($fragments)
	{
		if ($fragments instanceof MessageBag)
		{
			return Response::json(['errors' => $fragments->all()]);
		}

		return Response::json(['errors' => (array) $fragments]);
	}

}