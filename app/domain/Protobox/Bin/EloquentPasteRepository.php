<?php namespace Protobox\Bin;

use Protobox\Core\EloquentBaseRepository;

class EloquentPasteRepository extends EloquentBaseRepository implements PasteRepositoryInterface {

	public function __construct(Paste $model)
    {
        $this->model = $model;
    }

	public function getRecentPaginated($perPage = 20)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

}