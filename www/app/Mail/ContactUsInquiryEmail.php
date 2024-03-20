<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactUsInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $NAME, $SUBJECT, $INQUIRY, $CC_USER, $body,$PATIENT_NAME ,$PRODUCT_LIST;
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
        $to =config('constants.EMAIL_TO');
        $cc = config('constants.EMAIL_TO');;
        $subject = "# New Contact From {{$contact_data->name}} Check it.";
        return $this->to($to)->cc($cc)->from(config('mail.from.address'))->subject($subject)->view('admin.email.contactus_inquiry_email',compact('contact_data'));
    }
}
