<?php

namespace Models;

use Models\Base\Model;
use Models\Category;
use Models\ItemImage;
use Models\User;

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

    public function user() {
        return $this->parallelTo(User::class, 'user_id')->first();
    }

    public function getcategory() {
        return $this->parallelTo(Category::class, 'category_id')->first();
    }

}