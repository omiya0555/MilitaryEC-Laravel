<x-app-layout>
    <script src="js/cart.js"></script>
    <p class="flex justify-center text-gray-500 mt-12 p-5">C A R T</p>

    @if($cartItems->isEmpty())
    <div>
        <p class="text-center text-gray-500 p-5">カートに商品がありません。</p>
        <a href="{{ route('products.index')}}" class="flex justify-center text-green-600 hover:text-green-800 bg-gray-100 w-1/3 mx-auto p-2 rounded-sm">商品を見にいく</a>
    </div>
    @else
    
    <!-- flash message -->
    @include('components/flash')

    <form action="{{ route('addresses.index') }}" method="GET" class="flex justify-center mb-2">
        @csrf
        <div class="flex justify-center">
            <?php $cart_amount = 0; ?>
            <span class="text-xl m-auto mr-4" id="total-amount">合計金額 : {{ $cart_amount }}円</span>
            <button type="submit" class="border border-green-500 bg-green-500 hover:bg-green-700 text-lg" style="width:140px; height:50px; ">住所選択に進む</button>
        </div>
    </form>

    <!-- Cart Table -->
    <div class="flex justify-center m-16">
        <table class="table-auto w-full border-collapse text-left mt-6"
               style="min-width: 650px;">
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
                    <a href="{{ route('products.show',$cart->product->id)}}" >
                        <img src="{{$cart->product->image_path}}" alt="{{$cart->product->title}}" class="w-24 h-24 object-cover rounded">
                    </a>
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
                        {{ $cart->product->price * $cart->quantity }}<span class=" text-xs">円</span>
                    </td>                    
                    <td class="p-4">
                        <form action="{{ route('cart.destroy', ['productId' => $cart->product->id] ) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <button type="submit" class="p-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300 transition duration-200">
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