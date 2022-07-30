<?php

namespace Mail;

use Contributors\Mail\Mailer;

class PlanSubscribedAdminNoty extends Mailer
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
        return $this->html(content('mails/plan-subscribed-admin-noty', ['purchasePlanRequest' => $this->purchasePlanRequest, 'userSubscription' => $this->userSubscription]))
                    ->to(setting('app.admin_email'))
                    ->subject('User purchase a plan' . setting('app.title', 'Jolly Framework!'));
                    // ->attach('assets/css/welcome.css', 'checkout_this.css');
    }

}