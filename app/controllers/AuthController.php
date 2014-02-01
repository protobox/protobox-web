<?php

use Protobox\User\UserRepositoryInterface;

class AuthController extends BaseController {

	protected $users;

	public function __construct(UserRepositoryInterface $users)
	{
		$this->users = $users;
	}

	public function login()
	{
		return View::make('pages.account.login');
	}

	public function loginCreate()
	{
		$data = [
			'email' => mb_strtolower(Input::get('email')),
			'password' => Input::get('password')
		];

		$this->users->setRules([
			'email'      => 'required|email',
			'password'   => 'required'
		]);

		if (
			$this->users->isValid($data) && 
			$this->users->login($data['email'], $data['password'], Input::get('remember') == 'yes')
		)
		{
			return Redirect::route('account');
		}

		return Redirect::back()
			->withInput()
			->withErrors($this->users->getErrors());
	}

	public function register()
	{
		return View::make('pages.account.register');
	}

	public function registerCreate()
	{
		$data = [
			'name' => Input::get('name'),
			'email' => mb_strtolower(Input::get('email')),
			'password' => Input::get('password')
		];

		$this->users->setRules([
			'name'       => 'required|max:255',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:6'
		]);

		if (
			$this->users->isValid($data) && 
			$this->users->create($data) && 
			$this->users->login($data['email'], $data['password'], true)
		)
		{
			return Redirect::route('account');
		}

		return Redirect::back()
			->withInput()
			->withErrors($this->users->getErrors());
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::route('login');
	}

}