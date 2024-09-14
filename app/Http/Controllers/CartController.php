<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $user = Auth::user(); 

        $cartItems = Cart::where('user_id', $user->id)
        ->get();
    
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

    //カートの商品を購入する処理
    public function purchase(Request $request)
    {
        $user = Auth::user();

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'user_id'       => $user->id,
                'total_amount'  => $this->calculateCartTotal($user->id),
            ]);

            // Retrieve all cart items for the user
            $cartItems = Cart::where('user_id', $user->id)->get();

            foreach ($cartItems as $cartItem) {
                // Create an order item record
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $cartItem->product_id,
                    'quantity'      => $cartItem->quantity,
                    'name'          => $cartItem->product->name,
                    'description'   => $cartItem->product->description,
                    'image_path'    => $cartItem->product->image_path,
                    'price'         => $cartItem->product->price,
                ]);
            }

            // Clear the cart
            Cart::where('user_id', $user->id)->delete();

            //Commit the transaction
            DB::commit();

            return redirect()->route('orders.index')->with('success', '注文が完了しました！');

        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', '注文処理中にエラーが発生しました。');
        }
    }

    private function calculateCartTotal($userId)
    {
        $cartItems = Cart::where('user_id', $userId)->get();
        $totalAmount = 0;

        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->product->price * $cartItem->quantity;
        }

        return $totalAmount;
    }
}
