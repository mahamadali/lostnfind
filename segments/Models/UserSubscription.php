<?php

namespace Models;

use Models\Base\Model;

class UserSubscription extends Model
{
	protected $table = 'user_subscriptions';

	public function plan() {
		return $this->parallelTo(Subscription::class, 'plan_id')->first();
	}

}