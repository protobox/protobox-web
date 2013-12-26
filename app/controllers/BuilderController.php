<?php

class BuilderController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['create']]);

        //$this->afterFilter('clear_input', ['only' => ['create']]);
    }

    public function index()
    {
        $builder = App::make('boxbuilder');

        return View::make('pages.builder.index', compact('builder'));
    }

    public function create()
    {
        $builder = App::make('boxbuilder');

        if ( ! $builder->valid())
        {
            //if ($this->isPjax()) return $this->pjaxError($builder->errors());

            return Redirect::route('builder')->withInput()->withErrors($builder->errors());
        }

        return $this->download($builder->output(), 'custom.yml');
    }

    private function download($output, $filename = 'download')
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