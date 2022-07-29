<?php

namespace Mail;

use Contributors\Mail\Mailer;

class NotifyItemEmail extends Mailer
{
    public $user;

    public function __construct($email,$name,$message)
    {
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
    }

    public function prepare()
    {
        return $this->html(content('mails/notify-item', ['name' => $this->name,'message' => $this->message]))
                    ->to($this->email)
                    ->subject('Notify Item ' . setting('app.title', 'Jolly Framework!'));
    }

}