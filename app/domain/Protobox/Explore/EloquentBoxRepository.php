<?php namespace Protobox\Explore;

use Protobox\Core\EloquentBaseRepository;

class EloquentBoxRepository extends EloquentBaseRepository implements BoxRepositoryInterface {

	public function __construct(Box $model)
	{
		$this->model = $model;
	}

	public function getRecentPaginated($perPage = 20)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

	public function create($data = [])
	{
		return $this->model->create($data);
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getByDocument($document)
	{
		return $this->model->where('document', '=', $document)->first();
	}

}