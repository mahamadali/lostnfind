<?php

namespace Models;

use Models\Base\Model;

class Tag extends Model
{
	protected $table = 'tags';
    protected $with = ['category'];

    public function category() {
        return $this->parallelTo(Category::class, 'category_id');
    }
}