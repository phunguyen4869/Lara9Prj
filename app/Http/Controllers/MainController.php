<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SearchService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Category\CategoryService;

class MainController extends Controller
{
    protected $sliders;
    protected $products;
    protected $categories;
    protected $search;

    public function __construct(SliderService $sliders, ProductService $products, CategoryService $categories, SearchService $search)
    {
        $this->sliders = $sliders;
        $this->products = $products;
        $this->categories = $categories;
        $this->search = $search;
    }

    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $products = $this->search->search($request->input('search'));
            //dd($products);

            return view('search', [
                'title' => 'Search',
                'products' => $products
            ]);
        }

        if (!empty($request->user()->name)) {
            $userName = $request->user()->name;
        } else {
            $userName = null;
        }

        return view('home', [
            'title' => 'Trang chủ',
            'sliders' => $this->sliders->show(),
            'products' => $this->products->get(),
            'userName' => $userName,
        ]);
    }

    public function showProductModal(Request $request)
    {
        $product = $this->products->show($request->id);

        $product->price = number_format($product->price);
        $product->price_sale = number_format($product->price_sale);

        if (!empty($product)) {
            return response()->json([
                'error' => false,
                'data' => $product,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function showProductDetail($id = '', $slug = '')
    {
        $product = $this->products->show($id);
        $productsMore = $this->products->more($id, $product->category_id);

        $product->price = number_format($product->price);
        $product->price_sale = number_format($product->price_sale);

        $product->thumb = explode(',', $product->thumb);

        $categories = $this->categories->getAll();

        return view('products.detail', [
            'title' => $product->name,
            'product' => $product,
            'productsMore' => $productsMore,
            'categories' => $categories,
        ]);
    }

    public function loadMore(Request $request)
    {
        $products = $this->products->get($request->page);

        if (count($products) != 0) {
            $html = view('products.list', [
                'products' => $products,
            ])->render();

            return response()->json([
                'html' => $html,
            ]);
        }

        return response()->json([
            'html' => '',
        ]);
    }
}
