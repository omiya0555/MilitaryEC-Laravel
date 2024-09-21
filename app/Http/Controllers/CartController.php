<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $cartItemCount = 0;
            if (Auth::check()) {
                $cartItemCount = Cart::where('user_id', Auth::id())->sum('quantity');
            }
            $view->with('cartItemCount', $cartItemCount);
        });
    }

    // 商品一覧表示
    public function index()
    {
        $user = Auth::user(); 

        $cartItems = Cart::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
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

    // 商品をカートから削除
    public function destroy(Request $request, $productId)
    {
        $user = Auth::user();

        //すでに商品がカートに存在するか確認
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success','カートにアイテムを削除しました！');
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

        // ユーザーに関連するカートのアイテムを取得
        $cartItems = Cart::where('user_id', $user->id)->get();
        // カートが空の場合はエラーメッセージを返してアドレスページにリダイレクト
        //　そもそもカートが空ならカートページで購入ページを押せない
        //　この処理では、購入後に前のページに戻り、アドレスページから空購入を行うパターンを防止する。
        if ($cartItems->isEmpty()) {
            return redirect()->route('addresses.index')->with('error', 'カートが空です。商品を追加してください。');
        }

        // 選択されたアドレスのIDを$requestから受け取り、それをもって住所情報を取得する。
        $selectedAddress = Address::where('id', $request->address_id)->first();


        //トランザクションの開始
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'user_id'         => $user->id,
                'total_amount'    => $this->calculateCartTotal($user->id),
                'postal_code'     => $selectedAddress->postal_code,
                'prefecture'      => $selectedAddress->prefecture,
                'city'            => $selectedAddress->city,
                'street_address'  => $selectedAddress->street_address,
                'building'        => $selectedAddress->building,
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

    public function getCartCount()
    {
        $user = Auth::user();
        $cartItemCount = Cart::where('user_id', $user->id)->sum('quantity');
    
        return response()->json(['count' => $cartItemCount]);
    }

    // カートに商品を追加する
    public function addToCart(Request $request, Product $product)
    {
        // バリデーション（リクエストのproduct_idが存在するか確認）
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // カートに商品を追加または更新（すでに存在する場合は数量を増加）
        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => \DB::raw('quantity + 1'),
            ]
        );

        // 成功メッセージを返す（JSON形式）
        return response()->json(['success' => true, 'message' => '商品がカートに追加されました']);
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        $user = Auth::user();

        $cartItemCount = Cart::where('user_id', $user->id)->sum('quantity');
        

        //すでに商品がカートに存在するか確認
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();
            
        if($cartItem){
            //すでに商品がカートに存在するなら数量を追加
            $cartItem->quantity += 1;
            $cartItem->save();
        
        }else{
            //存在しないならカラムを作成
            Cart::create([
                'user_id'       => $user->id,
                'product_id'    => $id,
                'quantity'      => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'product' => [
                'name' => $product->name,
                'image_path' => $product->image_path,
                'cart_item_count' => $cartItemCount
            ]
        ]);
    }

}