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

    public function show($hashed)
    {
        $hash = Hashids::decode($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        //Detect user agent, if its the installer redirect to raw
        if (Request::server('HTTP_USER_AGENT') == 'Protobox')
        {
        	$box->download_count += 1;
        	$box->last_viewed = Carbon::now();
        	$box->save();

            return $this->raw($hashed);
        }

        $box->view_count += 1;
        $box->last_viewed = Carbon::now();
        $box->save();

        return View::make('pages.explore.show', [
            'box' => $box,
            'id' => $hashed
        ]);
    }

    public function edit($hashed)
    {
        try
        {
            $hash = Hashids::decode($hashed);
            $id = count($hash) ? $hash[0] : null;

            if ( ! $box = $this->box->getById($id)) 
            {
                return Response::view('pages.404.index', ['msg' => 'Box not found'], 404);
            }

            $box->fork_count += 1;
	        $box->last_viewed = Carbon::now();
	        $box->save();

            $builder = App::make('boxbuilder');

            $data = $builder->load($box->code);

            return Redirect::route('builder')
                ->withInput($data);
        }
        catch(Exception $e)
        {
            return Redirect::route('builder')
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }

    public function raw($hashed)
    {
        $hash = Hashids::decode($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        return Response::make($box->code)->header('Content-Type', 'text/plain');
    }

    public function download($hashed)
    {
        $hash = Hashids::decode($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        return $this->download_file($box->code, 'custom.yml');
    }

    private function download_file($output, $filename = 'download')
    {
        //return Response::download($builder->output(), 'common.yml');

        return Response::make($output)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Description', 'Protobox Manifest')
            ->header('Content-Disposition', 'attachment; filename='.$filename)
            ->header('Content-Transfer-Encoding', 'binary')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

}