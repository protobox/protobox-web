<?php namespace Protobox\Builder;

use Protobox\Core\EloquentBaseRepository;

class EloquentBoxRepository extends EloquentBaseRepository implements BoxRepositoryInterface {

	public function __construct(Box $model)
	{
		$this->model = $model;
	}

	public function create($data = [])
	{
		return $this->model->create($data);
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

}