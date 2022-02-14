<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;

class DashboardController extends Controller
{
    protected $orders;

    public function __construct(OrderService $orders)
    {
        $this->orders = $orders;
    }

    public function index(Request $request)
    {
        $name = $request->user()->attributesToArray()['name'];
        $orders = $this->orders->getOrderbyCustomer($request->user()->id);

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'name' => $name,
            'orders' => $orders,
        ]);
    }
}
