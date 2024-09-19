<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //購入履歴の一覧を表示
    public function index()
    {
        $user = Auth::user();

        //ログインユーザーの注文履歴を取得
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with('items')
            ->paginate(5);

        return view('orders.index', compact('orders'));
    }
}
