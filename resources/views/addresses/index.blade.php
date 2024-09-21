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
        <button id="newAddressBtn">別の住所を入力する</button>

        <form id="newAddressForm" action="{{ route('addresses.store') }}" method="POST" style="display:none;">
            @csrf
            <!-- 新しい住所の入力フォーム（前述の入力フォーム） -->
            <button type="submit">新しい住所で決済へ進む</button>
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
            <!-- 新しい住所の入力フォーム（前述の入力フォーム） -->
            <button type="submit">住所を保存して決済へ進む</button>
        </form>
    @endif
</x-app-layout>