<?php

namespace App\Mail;

use App\Models\Trucking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TruckingDelivered extends Mailable
{
    use Queueable, SerializesModels;

    public $trucking;

    public function __construct(Trucking $trucking)
    {
        $this->trucking = $trucking;
    }

    public function build()
    {
        return $this->subject('Your Order Has Been Delivered')
            ->view('emails.trucking_delivered');
    }
}
