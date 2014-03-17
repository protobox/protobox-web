<?php

use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Protobox\Builder\BoxRepositoryInterface;

class BuilderController extends BaseController {

    private $box;

    public function __construct(BoxRepositoryInterface $box)
    {
        $this->box = $box;

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

        $newbox = $this->box->create([
            'author_id' => Auth::user() ? Auth::user()->id : null
        ]);

        $box_id = $newbox->publicID();

        $newbox->update([
            'code' => $builder->output([
                'document' => $box_id, 
                'box_id' => $box_id
            ]),
        ]);

        $newbox->save();

        return Redirect::route('builder.show', ['id' => $box_id]);
    }

    public function show($hashed)
    {
        //Detect user agent, if its the installer redirect to raw
        if (Request::server('HTTP_USER_AGENT') == 'Protobox')
        {
            return $this->raw($hashed);
        }

        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::make('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        $box->view_count += 1;
        $box->last_viewed = Carbon::now();
        $box->save();

        return View::make('pages.builder.show', [
            'code' => $box->code,
            'id' => $hashed
        ]);
    }

    public function edit($hashed)
    {
        try
        {
            $hash = Hashids::decrypt($hashed);
            $id = count($hash) ? $hash[0] : null;

            if ( ! $box = $this->box->getById($id)) 
            {
                return Response::make('pages.404.index', ['msg' => 'Box not found'], 404);
            }

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

    public function upload()
    {
        try
        {
            $yaml = Input::get('config');

            if (empty($yaml))
            {
                return Redirect::route('builder')
                    ->withInput()
                    ->withErrors('Your config file does not contain any data');
            }

            $builder = App::make('boxbuilder');

            $data = $builder->load($yaml);

            return Redirect::route('builder')
                ->withInput($data)
                ->with('messages', new MessageBag([
                    'global' => 'Successfully imported your configuration file'
                ]));
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
        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::make('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        return Response::make($box->code)->header('Content-Type', 'text/plain');
    }

    public function download($hashed)
    {
        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::make('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        return $this->download_file($box->code, 'custom.yml');
    }

    public function delete($hashed)
    {
        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $box = $this->box->getById($id)) 
        {
            return Response::make('pages.404.index', ['msg' => 'Box not found'], 404);
        }

        $box->delete();

        return Redirect::route('builder');
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