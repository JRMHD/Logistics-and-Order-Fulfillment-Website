<?php

// app/Mail/OrderCreatedNotification.php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('New Order Created - ' . $this->order->tracking_number)
            ->view('emails.order-created-notification')
            ->with([
                'order' => $this->order,
                'company' => $this->order->client,
            ]);
    }
}
