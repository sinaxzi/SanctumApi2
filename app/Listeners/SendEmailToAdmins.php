<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Mail\CreateMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailToAdmins implements ShouldQueue
{


    public function handle(CreateUserEvent $event)
    {
        $admin_users = User::all()->where('IsAdmin',1);
        foreach ($admin_users as $admin_user){
            Mail::send(new CreateMail($event->user,$admin_user));

        }

    }
}
