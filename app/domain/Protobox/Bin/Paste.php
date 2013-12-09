<?php namespace Protobox\Bin;

use Protobox\Core\EloquentBaseModel;

class Paste extends EloquentBaseModel {

    protected $table      = 'pastes';
    protected $fillable   = ['code', 'author_id', 'parent_id'];
    protected $softDelete = true;

    protected $validationRules = [
        'code' => 'required',
    ];

    public function parent()
    {
        return $this->belongsTo('Protobox\Bin\Paste', 'parent_id');
    }
    
}