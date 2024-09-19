<x-app-layout>
    <div class="m-4" style="padding: 0 10%;">
        <p class="flex justify-center text-gray-700 pt-5 my-12">{{ $product->name }}</p>
        
        <!-- PopUp -->
        <div id="popup" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-md w-full relative">
                <button id="popup-close" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    ✕
                </button>
                <h2 class="text-2xl font-bold text-green-600 mb-4">カートに商品を追加しました！</h2>
                <img id="popup-image" src="/{{ $product->image_path }}" alt="Product Image" class="mx-auto mb-4" style="width: 100px; height: 100px;"/>
                <p id="popup-product-name" class="text-gray-700 mb-6"></p>
                <a href="{{ route('cart.index') }}" class="text-blue-600 font-semibold hover:underline">カートを見に行く</a>
            </div>
        </div>
        
        <!-- description -->
        <div class="flex justify-center" style="min-width:537px;">
            <img src="/{{ $product->image_path }}" style="min-width:200px;max-width:450px; min-height:200px; max-height:450px; object-fit:cover;">
            <div class="p-4 ml-4 relative">
                <div class="mb-1 w-60">【商品名】<br/>{{ $product->name}}</div><br/>
                <div class="mb-1">【カテゴリー】<br/>{{ $product->category->name }}</div><br/>
                <div class="mb-1">【説明】<br/>{{ $product->description}}</div><br/>
                <div class="mb-1">【価格】<br/>{{ $product->price}}円</div><br/>
                <div class="flex justify-between">
                <a href="{{ route('products.index') }}" class=" text-white items-center">
                    <button class="absolute bottom-0  flex justify-start mx-2 p-2 border border-green-500 bg-green-500 hover:bg-green-700">
                        TOPへ戻る
                    </button>
                </a>
                <button class="absolute bottom-0 right-0 flex justify-start mx-2 p-2 border border-green-500 bg-green-500 hover:bg-green-700 add-to-cart" data-id="{{ $product->id }}">
                    <span class=" text-white items-center">カートに追加</span>
                </button>
                </div>
            </div>
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
                        popupImage.src = '/'+data.product.image_path;
                        popupProductName.textContent = data.product.name;
                        if(data.product.cart_item_count === 0 ){
                            document.getElementById('cart-count').innerText = 1;
                        }else{
                            document.getElementById('cart-count').innerText = Number(data.product.cart_item_count) + 1;
                        }

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