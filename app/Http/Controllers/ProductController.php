<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    // 商品詳細表示
    public function show($id)
    {
        $product = Product::with('category')
            ->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品登録処理
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        Product::create($validatedData);

        return redirect()->route('products.index');
    }

    // 商品更新処理
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('products.show', $product->id);
    }

    // 商品削除処理
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}