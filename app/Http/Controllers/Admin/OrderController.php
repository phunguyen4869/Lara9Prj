<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderService $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->get();

        return view('admin.order.list', [
            'title' => 'Order List',
            'orders' => $orders,
        ]);
    }
}
