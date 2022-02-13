<?php

namespace App\Http\Services\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function get()
    {
        $orders = Order::all();

        foreach ($orders as $key => $value) {
            $products_id[$key] = $value->product_id;
            $quantity[$key] = $value->quantity;
        }

        foreach ($products_id as $key => $value) {
            $products_id[$key] = explode('&', $value);
            $quantity[$key] = explode('&', $quantity[$key]);
        }
        $orders = $orders->toArray();
        foreach ($orders as $key => $value) {
            $orders[$key]['product_id'] = $products_id[$key];
            $orders[$key]['quantity'] = $quantity[$key];
        }

        foreach ($orders as $key1 => $value) {
            $products_id = $value['product_id'];
            $products = [];
            foreach ($products_id as $key2 => $value) {
                $product = Product::select('name')->where('id', $value)->first();
                $products[$key2] = $product->name;
            }
            $orders[$key1]['products'] = $products;
        }

        return $orders;
    }

    public function getOrderbyId($id)
    {
        $order = Order::where('id', $id)->first();

        $order->product_id = explode('&', $order->product_id);
        $order->quantity = explode('&', $order->quantity);

        foreach ($order->product_id as $key => $value) {
            $product = Product::select('name')->where('id', $value)->first();
            $products[$key] = $product->name;
        }
        $order->products = $products;

        return $order;
    }

    public function getCustomer($id)
    {
        $customer = Customer::where('id', $id)->first();

        return $customer;
    }

    public function updatePaymentMethod($order, $request)
    {
        try {
            $order = Order::where('id', $order->id)->first();
            $order->payment_method = $request->payment_method;
            $order->save();

            $customer = Customer::where('id', $order->customer_id)->first();
            $customer->credit_card_number = $request->credit_card_number;
            $customer->expiration_date = $customer->expiration_date;
            $customer->cvv_code = $customer->cvv_code;
            $customer->credit_card_name = $customer->credit_card_name;
            $customer->atm_card_number = $customer->atm_card_number;
            $customer->bank_name = $customer->bank_name;
            $customer->atm_card_name = $customer->atm_card_name;
            $customer->save();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return false;
        }
        return true;
    }

    public function changeStatus($request)
    {
        $order = Order::where('id', $request->input('id'))->first();

        if ($order) {
            $order->status = $request->input('status');
            $order->save();
            return true;
        }

        return false;
    }
}
