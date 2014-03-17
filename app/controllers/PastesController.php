<?php

use Protobox\Bin\PasteRepositoryInterface;

class PastesController extends BaseController
{
    private $pastes;

    public function __construct(PasteRepositoryInterface $pastes)
    {
        $this->pastes = $pastes;

        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::error('404');

        //$pastes = $this->pastes->getRecentPaginated();

        return View::make('pages.pastes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('pages.pastes.create', [
            'fork' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $paste = $this->pastes->getNew([
            'code' => Input::get('paste'),
            'author_id' => Auth::user() ? Auth::user()->id : null
        ]);

        if ( ! $paste->isValid())
        {
            return Redirect::back()->withInput()->withErrors($paste->getErrors());
        }

        $this->pastes->save($paste);

        return Redirect::route('bin.show', ['id' => Hashids::encrypt($paste->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($hashed)
    {
        $hash = Hashids::decrypt($hashed);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $paste = $this->pastes->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Paste not found'], 404);
        }

        return View::make('pages.pastes.show', [
            'paste' => $paste->code,
            'id' => $hashed
        ]);
    }

    /**
     * Forking a paste
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($hash)
    {
        $hash = Hashids::decrypt($hash);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $paste = $this->pastes->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Paste not found'], 404);
        }

        return View::make('pages.pastes.create', [
            'fork' => $paste->code
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($hash)
    {
        $hash = Hashids::decrypt($hash);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $paste = $this->pastes->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Paste not found'], 404);
        }

        $paste = $this->pastes->getNew([
            'code' => Input::get('paste'),
            'author_id' => Auth::user() ? Auth::user()->id : null,
            'parent_id' => $id
        ]);

        if ( ! $paste->isValid())
        {
            return Redirect::back()->withInput()->withErrors($paste->getErrors());
        }

        $this->pastes->save($paste);

        return Redirect::route('bin.show', ['id' => Hashids::encrypt($paste->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($hash)
    {
        return Response::error('404');
    }

    /**
     * Raw response
     *
     * @param  int  $id
     * @return Response
     */
    public function raw($hash)
    {
        $hash = Hashids::decrypt($hash);
        $id = count($hash) ? $hash[0] : null;

        if ( ! $paste = $this->pastes->getById($id)) 
        {
            return Response::view('pages.404.index', ['msg' => 'Paste not found'], 404);
        }

        return Response::make($paste->code)->header('Content-Type', 'text/plain');
    }

}