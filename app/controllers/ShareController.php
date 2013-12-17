<?php

use Illuminate\Support\MessageBag;

class ShareController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['create']]);
    }

    public function create()
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

    public function show($hashed)
    {
        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $paste = $this->pastes->getById($id)) 
        {
            return App::abort(404, 'Paste not found');
        }

        return View::make('pages.pastes.show', [
            'paste' => $paste->code,
            'id' => $hashed
        ]);
    }

}