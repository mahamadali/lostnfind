<?php

namespace Models;

use Models\Base\Model;

class Subscription extends Model
{
	protected $table = 'subscriptions';

	protected $with = ['category'];

	public function category() {
		return $this->parallelTo(Category::class, 'category_id');
	}

}