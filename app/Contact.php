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

    /**
     * Send new contact email on new contact table record
     *
     * @return void
     */
    protected static function boot():void
    {
        parent::boot();

        static::created(function ($contact) {
            $contact->to = env("MAIL_TO", "guy-smiley@example.com");
            Mail::send(new NewContactMail($contact));
        });
    }    
}
