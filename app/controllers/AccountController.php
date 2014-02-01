<?php

use Protobox\User\UserRepositoryInterface;

class AccountController extends BaseController {

	protected $users;

	public function __construct(UserRepositoryInterface $users)
	{
		$this->users = $users;

		$this->beforeFilter('auth');
	}

	public function dashboard()
	{
		return View::make('pages.account.dashboard');
	}

}