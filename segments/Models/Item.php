<?php

namespace Models;

use Models\Base\Model;
use Models\Category;
use Models\ItemImage;

class Item extends Model
{
	protected $table = 'items';
    protected $with = ['category', 'images'];

    public function category() {
        return $this->parallelTo(Category::class, 'category_id');
    }

    public function images() {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

}