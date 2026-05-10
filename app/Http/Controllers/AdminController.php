<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Admin Dashboard - Product listing
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        return view('admin.dashboard', compact('products'));
    }

    /**
     * Show create product form
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a new product
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:256',
            'description' => 'nullable|string|max:1024',
            'image' => 'nullable|string|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'view' => 0,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Show edit product form
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update a product
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:256',
            'description' => 'nullable|string|max:1024',
            'image' => 'nullable|string|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'image', 'price', 'quantity', 'category_id']));

        return redirect()->route('admin.dashboard')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Delete a product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Xóa sản phẩm thành công!');
    }
}
