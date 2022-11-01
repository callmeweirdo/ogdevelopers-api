<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mailer\Envelope;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;


    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->data = $contact;
    }







    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Stemlab_kano Contact Us Message')->from($this->data->email)->markdown('view.contact', ['data' => $this->data]);
    }
}
