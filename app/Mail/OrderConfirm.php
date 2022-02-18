<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $customerName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $customerName)
    {
        $this->order = $order;
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderID = $this->order->id;
        $quantity = $this->order->quantity;
        $total = $this->order->total;
        $payment_method = $this->order->payment_method;
        $products = $this->order->products;

        $customerName = $this->customerName;

        return $this->markdown('admin.Order.OrderConfirm', [
            'url' => 'http://lara9shop.test',
            'orderID' => $orderID,
            'quantity' => $quantity,
            'total' => number_format($total),
            'payment_method' => $payment_method,
            'products' => $products,
            'customerName' => $customerName,
        ]);
    }
}
