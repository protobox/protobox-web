<?php namespace Protobox\Builder;

use Hashids;
use Protobox\Core\EloquentBaseModel;

class Box extends EloquentBaseModel {

    protected $table      = 'shares';
    protected $fillable   = ['code', 'author_id'];
    protected $softDelete = true;

    protected $validationRules = [
        'code' => 'required',
    ];

    public function publicID()
    {
        return Hashids::encrypt($this->id);
    }

}