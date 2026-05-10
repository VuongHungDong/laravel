<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        $products = Product::when($query, function ($q) use ($query) {
            return $q->where('name', 'like', '%' . $query . '%')
                     ->orWhere('description', 'like', '%' . $query . '%');
        })->paginate(12);

        return view('search', compact('products', 'query'));
    }
}
