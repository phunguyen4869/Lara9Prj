<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;

class APIOrderController extends Controller
{
    protected $orders;

    public function __construct(OrderService $orders)
    {
        $this->orders = $orders;
    }

    public function getOrder(Request $request)
    {
        $orders = $this->orders->getOrderbyCustomer($request->user()->id);

        return response()->json($orders);
    }
}
