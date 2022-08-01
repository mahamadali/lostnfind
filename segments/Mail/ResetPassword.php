<?php

namespace Mail;

use Contributors\Mail\Mailer;

class ResetPassword extends Mailer
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function prepare()
    {
        return $this->html(content('mails/reset-password', ['user' => $this->user]))
                    ->to($this->user->email)
                    ->subject('RESET PASSWORD - ' . setting('app.title', 'Jolly Framework!'));
                    // ->attach('assets/css/welcome.css', 'checkout_this.css');
    }

}