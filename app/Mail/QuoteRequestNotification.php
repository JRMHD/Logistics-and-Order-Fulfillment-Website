<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    public function __construct(QuoteRequest $quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {
        return $this->subject('New Quote Request')
            ->view('emails.quote_request_notification')
            ->with(['quote' => $this->quote]);
    }
}
