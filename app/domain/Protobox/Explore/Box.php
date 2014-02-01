<?php namespace Protobox\Explore;

use Hashids;
use Protobox\Core\EloquentBaseModel;

class Box extends EloquentBaseModel {

    protected $table      = 'boxes';
    protected $fillable   = ['name', 'description', 'code', 'author_id'];
    protected $softDelete = true;

    public $validationRules = [
        'name' => 'required',
        'code' => 'required',
    ];

    public function publicID()
    {
        return Hashids::encrypt($this->id);
    }

}