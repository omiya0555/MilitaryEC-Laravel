<x-app-layout>
    <p class="flex justify-center text-gray-700 mt-12 p-5">A D D R E S S</p>

    @if($addresses->isNotEmpty())
        <form action="" method="POST">
            @csrf
            <div>登録済みの住所を選択</div>
            @foreach($addresses as $address)
                <div>
                    <input type="radio" name="address_id" value="{{ $address->id }}" checked>
                    <label>{{ $address->postal_code }} {{ $address->prefecture }} {{ $address->city }} {{ $address->street_address }} {{ $address->building }}</label>
                </div>
            @endforeach
            <button type="submit">この住所で決済へ進む</button>
        </form>
        <button id="newAddressBtn" >別の住所を入力する</button>

        <form id="newAddressForm" action="{{ route('addresses.store') }}" method="POST" style="display:none;">
            @csrf
            <!-- 新しい住所の入力フォーム -->
            @include('components.address-input-form')
        </form>

        <script>
            document.getElementById('newAddressBtn').addEventListener('click', function() {
                document.getElementById('newAddressForm').style.display = 'block';
            });
        </script>
    @else
        <!-- 住所が無い場合は新規入力フォームのみを表示 -->
        <form action="{{ route('addresses.store') }}" method="POST">
            @csrf
            @include('components.address-input-form')
        </form>
    @endif

    
    <script>
    // 住所APIにリクエスト
    // 郵便番号から住所を自動取得入力
    document.getElementById('postal_code').addEventListener('input', function() {
        let postalCode = this.value.replace('-', '');
        if (postalCode.length === 7) {
            fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postalCode}`)
            .then(response => response.json())
            .then(data => {
                if (data.results) {
                    document.getElementById('prefecture').value = data.results[0].address1;
                    document.getElementById('city').value = data.results[0].address2;
                    document.getElementById('street_address').value = data.results[0].address3;
                } else {
                    alert('住所が見つかりません');
                }
            });
        }
    });
    </script>

</x-app-layout>