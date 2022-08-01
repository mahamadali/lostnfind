<?php

namespace Mail;

use Contributors\Mail\Mailer;

class PlanSubscribed extends Mailer
{
    public $userSubscription;
    public $purchasePlanRequest;
    public $tag;

    public function __construct($userSubscription, $purchasePlanRequest, $tag)
    {
        $this->userSubscription = $userSubscription;
        $this->purchasePlanRequest = $purchasePlanRequest;
        $this->tag = $tag;
    }

    public function prepare()
    {
        return $this->html(content('mails/plan-subscribed', ['purchasePlanRequest' => $this->purchasePlanRequest, 'userSubscription' => $this->userSubscription, 'tag' => $this->tag]))
                    ->to($this->purchasePlanRequest->email)
                    ->subject('Plan Subscribed Successfully ' . setting('app.title', 'Jolly Framework!'));
                    // ->attach('assets/css/welcome.css', 'checkout_this.css');
    }

}