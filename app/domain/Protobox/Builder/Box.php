<?php namespace Protobox\Builder;

use Hashids;
use Protobox\Core\EloquentBaseModel;

class Box extends EloquentBaseModel {

    protected $table      = 'shares';
    protected $fillable   = ['code', 'author_id'];
    protected $softDelete = true;

    public $validationRules = [
        'code' => 'required',
    ];

    public function publicID()
    {
        return Hashids::encode($this->id);
    }

}