<?php namespace Protobox\Core;

use Eloquent;
use Validator;
use Protobox\Core\Exceptions\NoValidationRulesFoundException;
use Protobox\Core\Exceptions\NoValidatorInstantiatedException;

abstract class EloquentBaseModel extends Eloquent
{
    public $validationRules = [];
    protected $validator;

    public function isValid($data = [])
    {
        if ( ! isset($this->validationRules)) {
            throw new NoValidationRulesFoundException('no validation rule array defined in class ' . get_called_class());
        }

        $this->validator = Validator::make($data, $this->getPreparedRules());

        return $this->validator->passes();
    }

    public function getErrors()
    {
        if ( ! $this->validator) {
            throw new NoValidatorInstantiatedException;
        }

        return $this->validator->errors();
    }

    public function clearRelationsCache()
    {
        $this->relations = [];
    }

    protected function getPreparedRules()
    {
        return $this->replaceIdsIfExists($this->validationRules);
    }

    protected function replaceIdsIfExists($rules)
    {
        $newRules = [];

        foreach ($rules as $key => $rule) {
            if (str_contains($rule, '<id>')) {
                $replacement = $this->exists ? $this->getAttribute($this->primaryKey) : '';

                $rule = str_replace('<id>', $replacement, $rule);
            }

            array_set($newRules, $key, $rule);
        }

        return $newRules;
    }
}