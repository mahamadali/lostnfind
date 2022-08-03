<?php

namespace Mail;

use Contributors\Mail\Mailer;

class NewsletterEmail extends Mailer
{
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function prepare()
    {
        return $this->html(content('mails/newsletter', ['email' => $this->email]))
                    ->to($this->email)
                    ->subject('Newsletter ' . setting('app.title', 'Jolly Framework!'));
    }

}