<?php

namespace Mail;

use Contributors\Mail\Mailer;

class PlanRenew extends Mailer
{
    public $userSubscription;
    public $purchasePlanRequest;
    public $subject;

    public function __construct($userSubscription, $purchasePlanRequest,  $subject)
    {
        $this->userSubscription = $userSubscription;
        $this->purchasePlanRequest = $purchasePlanRequest;
        $this->subject = $subject;
    }

    public function prepare()
    {
        return $this->html(content('mails/plan-renew', ['purchasePlanRequest' => $this->purchasePlanRequest, 'userSubscription' => $this->userSubscription, 'subject' => $this->subject]))
                    ->to($this->purchasePlanRequest->email)
                    ->subject($this->subject . setting('app.title', 'Jolly Framework!'));
                    // ->attach('assets/css/welcome.css', 'checkout_this.css');
    }

}