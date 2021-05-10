<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->id = $params['id'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contact_data = resolve('contact')->getById($this->id);

        $cc = $bcc = [];
        $to = $contact_data->email;
        $cc[] = config('constants.PRACTICE_MANAGER_EMAILS');;
        $subject = "Contact US Replay";

        return $this->to($to)->cc($cc)->from(config('mail.from.address'))->subject($subject)->view('admin.email.contact_replay_email',compact('contact_data'));
    }
}
