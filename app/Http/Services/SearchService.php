<?php

namespace App\Http\Services;

use App\Models\Product;

class SearchService
{
    public function search($request)
    {
        $result = Product::where('name', 'like', '%' . $request . '%')->get();

        return $result;
    }
}
