<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ProductInquiryMail extends Mailable
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
        $this->PRODUCT_LIST = $params['product_lists'];
        $this->INQUIRY = $params['inquiry'];
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $record = resolve('inquiry')->getById($this->id);
        $product_list =  $this->PRODUCT_LIST;
        $inquiry = $this->INQUIRY;
        $cc = $bcc = [];
        $to =config('constants.EMAIL_TO');
        $cc = config('constants.EMAIL_TO');;
        $subject = "# New Inquiry From {{$record->name}} Check it.";
        return $this->to($to)->cc($cc)->from(config('mail.from.address'))->subject($subject)->view('admin.email.inquiry_email',compact('record','product_list','inquiry'));
    }
}
