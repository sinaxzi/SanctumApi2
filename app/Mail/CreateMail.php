<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $admin_user;
    public function __construct($user,$admin_user)
    {
        $this->user = $user;
        $this->admin_user = $admin_user;
    }

    public function build()
    {
        return $this->subject('Registering user')
            ->from('sina@example.com')
            ->to($this->admin_user->email)
            ->view('Mail.CreateUserEmail',['user' => $this->user]);
    }
}
