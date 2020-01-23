<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message and pass data to the email template
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-email')
            ->to($this->contact->to)
            ->subject('You have received a new message!')
            ->with([
                'to' => $this->contact->to,
                'from_name' => $this->contact->name,
                'from_email' => $this->contact->email,
                'from_phone' => $this->contact->phone,
                'body' => $this->contact->message
            ]);
    }
}
