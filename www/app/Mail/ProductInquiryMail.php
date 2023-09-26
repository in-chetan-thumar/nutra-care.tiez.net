<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ProductInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $NAME, $SUBJECT, $USER, $CC_USER, $body,$PATIENT_NAME ;
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
        $record = resolve('inquiry')->getById($this->id);
        $cc = $bcc = [];
        $to =config('constants.PRACTICE_MANAGER_EMAILS');
        $cc = config('constants.PRACTICE_MANAGER_EMAILS');;
        $subject = "# New Inquiry From {{$record->name}} Check it.";
        return $this->to($to)->cc($cc)->from(config('mail.from.address'))->subject($subject)->view('admin.email.inquiry_email',compact('record'));
    }
}
