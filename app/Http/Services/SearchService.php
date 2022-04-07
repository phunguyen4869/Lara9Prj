<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;

class SearchService
{
    public function search($request)
    {
        $result = Product::where('name', 'like', '%' . $request . '%')->where('active', '=', 1)->get();

        return $result;
    }

    public function adminSearch($search, $section)
    {
        switch ($section) {
            case 'slider':
                $results = $this->searchSliders($search);
                return $results;
                break;
            case 'category':
                $results = $this->searchCategories($search);
                return $results;
                break;
            case 'product':
                $results = $this->searchProducts($search);
                return $results;
                break;
            case 'user':
                $results = $this->searchUsers($search);
                return $results;
                break;
        }
    }

    public function searchSliders($search)
    {
        $slider = Slider::where('name', 'like', '%' . $search . '%')->paginate(5);

        // return $slider->withPath('/admin/search?search=' . $search . '&section=slider');
        return $slider->withQueryString();
    }

    public function searchCategories($search)
    {
        $categories = Category::where('name', 'like', '%' . $search . '%')->paginate(5);

        // return $categories->withPath('/admin/search?search=' . $search . '&section=category');
        return $categories->withQueryString();
    }

    public function searchProducts($search)
    {
        $products = Product::where('name', 'like', "%$search%")->paginate(5);

        // return $products->withPath('/admin/search?search=' . $search . '&section=post');
        return $products->withQueryString();
    }

    public function searchUsers($search)
    {
        $user = User::where('name', 'like', "%$search%")->paginate(5);

        // return $user->withPath('/admin/search?search=' . $search . '&section=user');
        return $user->withQueryString();
    }
}
