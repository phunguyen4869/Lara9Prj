<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;

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

    public function edit(Order $order)
    {
        $order = $this->order->getOrderbyId($order->id);
        $customer = $this->order->getCustomer($order->customer_id);

        return view('admin.order.edit', [
            'title' => 'Edit Order',
            'order' => $order,
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        if ($order->payment_method != $request->payment_method) {
            $result = $this->order->updatePaymentMethod($order, $request);

            if ($result) {
                return redirect('/admin/order/list')->with('success', 'Update payment method success');
            } else {
                return redirect()->back()->with('error', 'Update payment method fail');
            }
        } else {
            return redirect('/admin/order/list');
        }
    }

    public function changeStatus(Request $request)
    {
        $result = $this->order->changeStatus($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Đã cập nhật trạng thái đơn hàng',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra trong quá trình cập nhật trạng thái',
            ]);
        }
    }
}
