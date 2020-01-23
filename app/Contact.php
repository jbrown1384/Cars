<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($user) {
    //         $user->profile()->create([
    //             'title' => $user->username
    //         ]);

    //         // $user->following()->toggle($user->profile);
    //         Mail::to($user->email)->send(new NewUserWelcomeMail());
    //     });
    // }    
}
