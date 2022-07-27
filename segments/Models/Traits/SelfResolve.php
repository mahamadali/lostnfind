<?php

namespace Models\Traits;

use Bones\Str;
use JollyException\DatabaseException;

trait SelfResolve
{
    public function ___save()
    {
        $modelData = [];

        foreach ($this->dynamicAttributes as $attribute) {
            $modelData[$attribute] = $this->$attribute;
        }

        if (!empty($modelData[$this->primary_key])) {
            if ($this->___clearWhere()->where($this->primary_key, $modelData[$this->primary_key])->update($modelData)) {
                return $this->___clearWhere()->where($this->primary_key, $modelData[$this->primary_key])->first();
            } else {
                throw new DatabaseException('Database error occured while updating ' . $this->model . ' for {' . $this->primary_key . '} with "'. $modelData[$this->primary_key] .'"');
            }
        } else {
            return $this->___clearWhere()->insert($modelData);
        }

        throw new DatabaseException('Database error occured while saving ' . $this->model);
    }

    public function ___transformElement($transformType, $value, $operation = 'set')
    {
        if ($value == null) return $value;
        
        if ($operation == 'get') {

            switch ($transformType) {
                case 'boolean':
                    $value = ($value == 1) ? TRUE : FALSE;
                    break;
                default:
                    break;
            }

        } else if ($operation == 'set') {

            switch ($transformType) {
                case 'int':
                    $value = (int) $value;
                    break;
                case 'float':
                    $value = (float) $value;
                    break;
                case 'real':
                    $value = (float) $value;
                    break;
                case 'double':
                    $value = (double) $value;
                    break;
                case 'json':
                    $value = json_encode($value);
                    break;
                case 'slug':
                    $value = Str::toSlug($value, '-');
                    break;
                default:
                    $value = $value;
                    break;
            }

        }

        if (Str::contains($transformType, 'decimal')) {
            $transformTypeParts = explode(':', $transformType);
            $preceision = (!empty($transformTypeParts) && is_numeric($transformTypeParts[1])) ? $transformTypeParts[1] : 2;
            $value = sprintf('%0.'.$preceision.'f', $value);
        }

        if (Str::contains($transformType, 'date')) {
            $transformTypeParts = explode(':', $transformType);
            $format = (!empty($transformTypeParts) && is_numeric($transformTypeParts[1])) ? $transformTypeParts[1] : 'Y-m-d';
            $value = date($format, strtotime($value));
        }

        if (Str::contains($transformType, 'datetime')) {
            $transformTypeParts = explode(':', $transformType);
            $format = (!empty($transformTypeParts) && is_numeric($transformTypeParts[1])) ? $transformTypeParts[1] : 'Y-m-d H:i:s';
            $value = date($format, strtotime($value));
        }

        return $value;
    }

    public function ___isSelfOnly()
    {
        return (!empty($this->_reserved_model_prop_is_only) && $this->_reserved_model_prop_is_only);
    }

    public function ___setSelfOnly($isOnly = false)
    {
        $this->_reserved_model_prop_is_only = $isOnly;
    }
    
}