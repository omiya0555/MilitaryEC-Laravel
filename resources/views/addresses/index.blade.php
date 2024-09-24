<x-app-layout>
    <!-- 決済フローを実現するための JavaScript のライブラリを直接ロードする。 -->
    <script src="https://js.stripe.com/v3/"></script>
    <p class="flex justify-center text-gray-700 mt-12 p-5">A D D R E S S</p>

    @include('components.flash')

    <div class="flex justify-center mt-8">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">

            <!-- Stripe用のポップアップフォーム -->
            <div id="payment-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                    <!-- ✕ボタン -->
                    <button id="close-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        ✕
                    </button>

                    <h2 class="text-lg font-bold mb-4">クレジットカード情報を入力してください</h2>

                    <!-- Stripeカード要素 -->
                    <form id="payment-form">
                        <div id="card-element" class="mb-4">
                            <!-- Stripe.jsがここにカード要素を挿入 -->
                        </div>
                        <div id="card-errors" class="text-red-500 mb-4" role="alert"></div>

                        <button id="submit-button" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            決済を実行
                        </button>
                    </form>
                </div>
            </div>

            @if($addresses->isNotEmpty())
                <form id="address-form" action="{{ route('cart.payment') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="text-gray-700 mb-4 text-center text-lg">登録済みの住所を選択</div>

                    @foreach($addresses as $address)
                        <div class="mb-4">
                            <input type="radio" name="address_id" value="{{ $address->id }}" class="mr-2"
                                {{ $loop->first ? 'checked' : '' }}>
                            <label class="text-gray-700">
                                {{ $address->postal_code }} {{ $address->prefecture }} {{ $address->city }} {{ $address->street_address }} {{ $address->building }}
                            </label>
                        </div>
                    @endforeach

                    <button id="checkout-button" type="button" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        決済へ進む
                    </button>
                </form>

                <button id="newAddressBtn" class="w-full bg-gray-300 hover:bg-gray-500 text-gray-700 font-bold py-2 px-4 rounded mb-6">
                    新しい住所を登録する
                </button>

                <form id="newAddressForm" action="{{ route('addresses.store') }}" method="POST" style="display:none;">
                    <hr>
                    <div class="text-gray-700 mb-4 text-center text-lg mt-8">新しい住所を登録</div>
                    @csrf
                    @include('components.address-input-form')
                </form>

                <a href="{{ route('cart.index') }}" class="relative top-4 bottom-0 left-0 text-gray-700">
                    戻る
                </a>
            @else
                <form action="{{ route('addresses.store') }}" method="POST">
                    <div class="text-gray-700 mb-4 text-center text-lg mt-2">新しい住所を登録</div>
                    @csrf
                    @include('components.address-input-form')
                </form>
            @endif
        </div>
    </div>

    <!-- 住所フォームのトグル表示 -->
    <script>
        document.getElementById('newAddressBtn').addEventListener('click', function() {
            document.getElementById('newAddressForm').style.display = 'block';
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Stripe公開キーを設定
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();

            // カード要素を作成 (郵便番号を非表示にする)
            const cardElement = elements.create('card', {
                hidePostalCode: true  // 郵便番号を非表示に設定
            });
            cardElement.mount('#card-element');

            // エラーハンドリング
            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // 決済ボタンのイベントリスナー
            document.getElementById('checkout-button').addEventListener('click', function() {
                // 画面中央にポップアップを表示
                document.getElementById('payment-modal').classList.remove('hidden');
                document.getElementById('payment-modal').style.display = 'flex';
            });

            // ポップアップを閉じる✕ボタンのイベントリスナー
            document.getElementById('close-modal').addEventListener('click', function() {
                const modal = document.getElementById('payment-modal');
                modal.style.display = 'none';  // displayをnoneに設定
                modal.classList.add('hidden'); // hiddenクラスも追加
            });

            // フォーム送信時の処理
            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                const {paymentMethod, error} = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    // エラー表示
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    // 成功時、サーバーに送信
                    stripeTokenHandler(paymentMethod.id);
                }
            });

            // トークンをサーバーに送信する関数
            function stripeTokenHandler(paymentMethodId) {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method_id');
                hiddenInput.setAttribute('value', paymentMethodId);
                document.getElementById('address-form').appendChild(hiddenInput);

                // クレジットカード情報を含むフォームを送信
                document.getElementById('address-form').submit();
            }
        });
    </script>
</x-app-layout>