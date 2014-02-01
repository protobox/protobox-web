<?php namespace Protobox\Bin;

use Protobox\Core\EloquentBaseModel;

class Paste extends EloquentBaseModel {

    protected $table      = 'pastes';
    protected $fillable   = ['code', 'author_id', 'parent_id'];
    protected $softDelete = true;

    public $validationRules = [
        'code' => 'required',
    ];

    public function parent()
    {
        return $this->belongsTo('Protobox\Bin\Paste', 'parent_id');
    }
    
}