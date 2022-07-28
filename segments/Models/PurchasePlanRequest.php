<?php

namespace Models;

use Models\Base\Model;

class PurchasePlanRequest extends Model
{
    protected $table = 'purchase_plan_requests';

    public function plan() {
        return $this->parallelTo(Subscription::class, 'plan_id');
    }

    public function category() {
        return $this->parallelTo(Category::class, 'category_id');
    }

    public function user_subscription() {
        return $this->hasOne(UserSubscription::class, 'user_id');
    }

}