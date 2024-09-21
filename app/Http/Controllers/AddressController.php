<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // 住所入力画面表示
    // すでに住所のデータがあれば表示する
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('addresses.index', compact('addresses'));
    }

    // 住所保存処理
    // 決済処理に進む　ボタンに実装
    public function store(Request $request)
    {

    
        $request->validate([
            'postal_code' => 'required|max:8',
            'prefecture' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'street_address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        Address::create([
            'postal_code' => $request->postal_code,
            'prefecture' => $request->prefecture,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'building' => $request->building,
            'user_id' => Auth::id(),
            
        ]);

        return redirect()->route('addresses.index')->with('success', '住所データを保存しました！');;
    }
}
