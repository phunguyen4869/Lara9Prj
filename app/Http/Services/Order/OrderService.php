<?php

namespace App\Http\Services\Order;

use App\Models\Order;
use App\Models\Product;

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
        //dd($orders);

        return $orders;
    }
}
