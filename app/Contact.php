<?php

namespace App;

use App\Mail\NewContactMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($contact) {
            $contact->to = env("MAIL_TO", "guy-smiley@example.com");
            Mail::send(new NewContactMail($contact));
        });
    }    
}
