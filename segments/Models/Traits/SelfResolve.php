<?php

namespace Models\Traits;

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
    
}