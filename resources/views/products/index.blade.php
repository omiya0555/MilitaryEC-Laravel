<x-app-layout>

    <!-- PopUp -->
    <!-- 商品がカートに追加されたときのみ表示　-->
    @if (session('success'))
        <div id="popup" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-md w-full">
                <h2 class="text-2xl font-bold text-green-600 mb-4">カートに商品を追加しました！</h2>
                <p class="text-gray-700 mb-6">商品がカートに追加されました。</p>
                <a href="{{ route('cart.index') }}" class="text-blue-600 font-semibold hover:underline">カートを見に行く</a>
            </div>
        </div>
    @endif

    <!-- Slider -->
    <x-slider></x-slider>

    <hr class="mt-12 p-2"/>
    
    <!-- New Products -->
    <p class="flex justify-center text-gray-700 mt-6 p-5">N E W</p>
    <div class="flex flex-wrap justify-center text-center gap-4 m-4 p-4">
        @foreach($products->slice(0, 4) as $product) <!-- 最初の4つの商品を取得 -->
            <div class="w-52 rounded overflow-hidden shadow-lg">
                <img src="{{ $product->image_path }}" style="width:auto; height:200px;">
                <div class="px-6 py-4">
                    <div class="font-bold mb-2">{{ $product->name }}</div>
                    <p class="text-gray-700 text-sm">
                        {{ $product->description }}
                    </p>
                </div>
                <div class="flex justify-between p-4">
                    <span class="bg-gray-200 w-20 h-10 flex justify-center items-center text-sm  text-gray-700">{{ (int)$product->price }}円</span>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-20 h-10 flex justify-center items-center border border-green-500 bg-green-500 hover:bg-green-700">
                            <span class="text-white items-center">
                                Add Item
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="mt-12 p-2"/>

    <!-- New Products -->
    <p class="flex justify-center text-gray-700 mt-6 p-5">P R O D U C T S</p>
    <div class="flex flex-wrap justify-center text-center gap-8 m-4 p-4 width: 50%;">
        @foreach($products as $product)
            <div class=" w-52 rounded overflow-hidden shadow-lg">
                <img src="{{ $product->image_path }}" style="width:auto; height:200px;">
                <div class="px-6 py-4">
                    <div class="font-bold mb-2">{{ $product->name }}</div>
                    <p class="text-gray-700 text-sm">
                        {{ $product->description }}
                    </p>
                </div>
                <div class=" flex justify-between p-4">
                    <span class="bg-gray-200 w-20 h-10 flex justify-center items-center text-sm  text-gray-700">{{ (int)$product->price }}円</span>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf
                        <button type="submit" class="w-20 h-10 flex justify-center items-center border border-green-500 bg-green-500 hover:bg-green-700">
                            <span class="text-white items-center">
                                Add Item
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Script -->
    <script>
        // ポップアップを自動的に閉じる
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('popup');
            if (popup) {
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 3000); // 3秒後に自動で非表示にする
            }
        });
    </script>
</x-app-layout>