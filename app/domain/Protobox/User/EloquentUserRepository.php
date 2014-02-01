<?php namespace Protobox\User;

use Auth;
use Hash;
use Protobox\Core\EloquentBaseRepository;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryInterface {

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function setRules($rules)
	{
		$this->model->validationRules = array_merge($this->model->validationRules, $rules);
	}

	public function find($id)
	{
		return $this->model->findOrFail($id);
	}

	public function create($data = [])
	{
		$data['password'] = Hash::make($data['password']);

		return $this->model->create($data);
	}

	public function update($data = [])
	{
		$pass = trim($data['password']);

		if (!empty($pass))
		{
			$data['password'] = Hash::make($pass);
		}
		else
		{
			unset($data['password']);
		}

		$this->model->fill($data)->save();
	}

	public function login($email, $password, $remember = false)
	{
		$user = $this->model->where('email', $email)->first();

		if ($user and Hash::check($password, $user->password))
		{
			Auth::login($user, $remember);

			return true;
		}

		return false;
	}

	public function isValid($data = [])
	{
		return $this->model->isValid($data);
	}

	public function getErrors()
	{
		return $this->model->getErrors();
	}

	public function getById($id)
	{
		return $this->find($id);
	}

}