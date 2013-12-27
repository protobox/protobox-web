<?php

use Carbon\Carbon;
use Protobox\Explore\BoxRepositoryInterface;

class ExploreController extends BaseController {

    private $box;

    public function __construct(BoxRepositoryInterface $box)
    {
        $this->box = $box;

        $this->beforeFilter('csrf', ['only' => ['create']]);

        //$this->afterFilter('clear_input', ['only' => ['create']]);
    }

    public function index()
    {
    	$boxes = $this->box->getRecentPaginated();

    	return View::make('pages.explore.index', [
    		'boxes' => $boxes
    	]);
    }

}