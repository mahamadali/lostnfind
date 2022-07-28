<?php

namespace Mail;

use Contributors\Mail\Mailer;

class PlanSubscribed extends Mailer
{
    public $userSubscription;
    public $purchasePlanRequest;

    public function __construct($userSubscription, $purchasePlanRequest)
    {
        $this->userSubscription = $userSubscription;
        $this->purchasePlanRequest = $purchasePlanRequest;
    }

    public function prepare()
    {
        return $this->html(content('mails/plan-subscribed', ['purchasePlanRequest' => $this->purchasePlanRequest, 'userSubscription' => $this->userSubscription]))
                    ->to($this->purchasePlanRequest->email)
                    ->subject('Plan Subscribed Successfully ' . setting('app.title', 'Jolly Framework!'));
                    // ->attach('assets/css/welcome.css', 'checkout_this.css');
    }

}