<x-app-layout>

    <!-- image -->
    <img src="background.png" style="background-size: cover; background-position: center; width: 100%; height: 100%;"></img>

    <div class="m-7" style="padding: 0 15%;">

        <!-- PopUp -->
        <div id="popup" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-md w-full relative">
                <button id="popup-close" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    ✕
                </button>
                <h2 class="text-2xl font-bold text-green-600 mb-4">カートに商品を追加しました！</h2>
                <img id="popup-image" src="" alt="Product Image" class="mx-auto mb-4" style="width: 100px; height: 100px;"/>
                <p id="popup-product-name" class="text-gray-700 mb-6"></p>
                <a href="{{ route('cart.index') }}" class="text-blue-600 font-semibold hover:underline">カートを見に行く</a>
            </div>
        </div>

        <!-- New Products -->
        <p class="flex justify-center text-gray-700 mt-6 p-5">N E W</p>
        <div class="flex flex-wrap justify-center text-center gap-8 m-4 p-4">
            @foreach($products->slice(0, 3) as $product)
                <div class="w-44 rounded overflow-hidden shadow-lg">
                    <img src="{{ $product->image_path }}" style="width:175px;">
                    <div class="px-2 py-2">
                        <div class="font-bold mb-2">{{ $product->name }}</div>
                        <p class="text-gray-700 text-sm">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="flex justify-between p-2">
                        <span class="bg-gray-200 w-15 h-10 p-1 flex justify-center items-center text-sm  text-gray-700">{{ (int)$product->price }}円</span>
                        <button class="w-15 h-10 flex justify-center items-center border border-green-500 bg-green-500 hover:bg-green-700 add-to-cart" data-id="{{ $product->id }}">
                            <span class="text-white items-center">Add Item</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Products -->
        <hr class="mt-12 p-2"/>
        <p class="flex justify-center text-gray-700 mt-6 p-5">P R O D U C T S</p>
        <div class="flex flex-wrap justify-center text-center gap-8 m-4 p-4">
            @foreach($products as $product)
                <div class="w-44 rounded overflow-hidden shadow-lg">
                    <img src="{{ $product->image_path }}" style="width:175px;">
                    <div class="px-2 py-2">
                        <div class="font-bold mb-2">{{ $product->name }}</div>
                        <p class="text-gray-700 text-sm">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="flex justify-between p-2">
                        <span class="bg-gray-200 w-15 h-10 p-1 flex justify-center items-center text-sm  text-gray-700">{{ (int)$product->price }}円</span>
                        <button class="w-15 h-10 p-1 flex justify-center items-center border border-green-500 bg-green-500 hover:bg-green-700 add-to-cart" data-id="{{ $product->id }}">
                            <span class="text-white items-center">Add Item</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const popup = document.getElementById('popup');
        const popupCloseButton = document.getElementById('popup-close');
        const popupImage = document.getElementById('popup-image');
        const popupProductName = document.getElementById('popup-product-name');

        // カートに追加ボタンのクリックイベント
        document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;

            // Ajaxリクエストを送信
            fetch(`/cart/${productId}/add`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // 商品の画像と名前をポップアップに表示
                    popupImage.src = data.product.image_path;
                    popupProductName.textContent = data.product.name;

                    // ポップアップを表示
                    popup.classList.remove('hidden');
                    setTimeout(() => {
                        popup.classList.add('hidden');
                    }, 3000); // 3秒後に自動で非表示
                }
            });
        });
    });
            // ✕ボタンでポップアップを閉じる
            popupCloseButton.addEventListener('click', function () {
                popup.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>