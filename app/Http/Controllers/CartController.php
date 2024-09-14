<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $cartItems = Cart::all();
        return view('carts.index', compact('cartItems'));
    }

    // 商品をカートに追加
    public function store(Request $request, $productId)
    {
        $user = Auth::user();

        //すでに商品がカートに存在するか確認
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();
            
        if($cartItem){
            //すでに商品がカートに存在するなら数量を追加
            $cartItem->quantity += 1;
            $cartItem->save();
        
        }else{
            //存在しないならカラムを作成
            Cart::create([
                'user_id'       => $user->id,
                'product_id'    => $productId,
                'quantity'      => 1,
            ]);
        }

        return redirect()->route('products.index')->with('success','カートにアイテムを追加しました！');
    }

    //　非同期レスポンス json形式で返す
    public function decrease(Request $request, $cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem && $cartItem->quantity > 0) {
            $cartItem->quantity -= 1;
            $cartItem->save();
    
            $product = $cartItem->product;
            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'price' => $product->price * $cartItem->quantity
            ]);
        }
        return response()->json(['success' => false]);
    }
    
    public function increase(Request $request, $cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
    
            $product = $cartItem->product;
            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'price' => $product->price * $cartItem->quantity
            ]);
        }
        return response()->json(['success' => false]);
    }
}
