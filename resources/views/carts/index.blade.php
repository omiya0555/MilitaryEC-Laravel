<x-app-layout>
    
    <p class="flex justify-center text-gray-700 mt-12 p-5">C A R T</p>

    @if($cartItems->isEmpty())
    <p class="text-center text-gray-700 p-5">カートに商品がありません。</p>
    @else
    
    <script src="js/cart.js"></script>
    
    <!-- flash message -->
    @include('components/flash')

    <form action="" method="POST" class="flex justify-center mb-2">
        @csrf
        <div class="flex justify-center">
            <?php
            //合計金額を求める
            $cart_amount = 0;
            foreach($cartItems as $cart)
            {
                $cart_amount += $cart->product->price * $cart->quantity;
            }
            ?>
            <span class="text-xl m-auto mr-4" id="total-amount">合計金額 : {{ $cart_amount }}円</span>
            <button type="submit" class="border border-green-500 bg-green-500 hover:bg-green-700 text-lg" style="width:140px; height:50px; ">購入</button>
        </div>
    </form>

    <!-- Cart Table -->
    <div class="flex justify-center m-16">
        <table class="table-auto w-full border-collapse text-left mt-6">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-4 text-gray-600">画像</th>
                    <th class="p-4 text-gray-600">商品名</th>
                    <th class="p-4 text-gray-600">説明</th>
                    <th class="p-4 text-gray-600">数量</th>
                    <th class="p-4 text-gray-600">価格</th>
                    <th class="p-4 text-gray-600">#</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $cart)
                <tr class="border-b hover:bg-gray-50 transition duration-200 ease-in-out">
                    <td class="p-4">
                        <img src="{{$cart->product->image_path}}" alt="{{$cart->product->title}}" class="w-24 h-24 object-cover rounded">
                    </td>
                    <td class="p-4 font-medium text-gray-800">{{$cart->product->name}}</td>
                    <td class="p-4 text-gray-600">{{$cart->product->description}}</td>
                    
                    
                    <td class="p-4 font-semibold text-gray-800">
                        <div class="flex items-center space-x-2 mt-2">
                            <!-- 減らすボタン -->
                            <button type="button" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded decrease-btn" data-id="{{ $cart->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                </svg>
                            </button>

                            <!-- 数量表示 -->
                            <span class="text-gray-800 quantity" id="quantity-{{ $cart->id }}">{{$cart->quantity}}</span>

                            <!-- 増やすボタン -->
                            <button type="button" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded increase-btn" data-id="{{ $cart->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                                </svg>
                            </button>
                        </div>
                    </td>
                    
                    
                    <td class="p-4 text-gray-800 price" id="price-{{ $cart->id }}">
                        {{ $cart->product->price * $cart->quantity }}円
                    </td>                    
                    <td class="p-4">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <button type="submit" class="px-4 py-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300 transition duration-200">
                                戻す
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-app-layout>