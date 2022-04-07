<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $section = $request->get('section');

        $results = $this->search->adminSearch($search, $section);

        switch ($section) {
            case 'slider':
                return view('admin.slider.list', [
                    'title' => 'Slider search',
                    'sliders' => $results,
                ]);
                break;
            case 'category':
                return view('admin.category.list', [
                    'title' => 'Category search',
                    'categories' => $results,
                ]);
                break;
            case 'product':
                return view('admin.product.list', [
                    'title' => 'Product search',
                    'products' => $results,
                ]);
                break;
            case 'user':
                return view('admin.users.list', [
                    'title' => 'User search',
                    'users' => $results,
                ]);
                break;
        }
    }
}
