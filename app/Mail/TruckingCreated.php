<?php

namespace App\Mail;

use App\Models\Trucking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TruckingCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $trucking;

    public function __construct(Trucking $trucking)
    {
        $this->trucking = $trucking;
    }

    public function build()
    {
        return $this->subject('Your Trucking Order is Created!')
            ->view('emails.trucking_created')
            ->with([
                'name' => $this->trucking->name,
                'tracking_number' => $this->trucking->tracking_number,
                'from_location' => $this->trucking->from_location,
                'to_location' => $this->trucking->to_location,
                'status' => $this->trucking->status,
            ]);
    }
}
