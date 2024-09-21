<x-app-layout>
    <p class="flex justify-center text-gray-700 mt-12 p-5">A D D R E S S</p>

    <div class="flex justify-center mt-8">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
            @if($addresses->isNotEmpty())
                <form action="" method="POST" class="mb-6">
                    @csrf
                    <div class="text-gray-700 mb-4 text-center text-lg">登録済みの住所を選択</div>
                    @foreach($addresses as $address)
                        <div class="mb-4">
                            <input type="radio" name="address_id" value="{{ $address->id }}" checked class="mr-2">
                            <label class="text-gray-700">{{ $address->postal_code }} {{ $address->prefecture }} {{ $address->city }} {{ $address->street_address }} {{ $address->building }}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">この住所で決済へ進む</button>
                </form>

                <button id="newAddressBtn" class="w-full bg-gray-300 hover:bg-gray-500 text-gray-700 font-bold py-2 px-4 rounded mb-6">別の住所を入力する</button>

                <form id="newAddressForm" action="{{ route('addresses.store') }}" method="POST" style="display:none;">
                    <hr>
                    <div class="text-gray-700 mb-4 text-center text-lg mt-8">新しい住所を入力</div>
                    @csrf
                    @include('components.address-input-form')
                </form>
            @else
                <form action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    @include('components.address-input-form')
                </form>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('newAddressBtn').addEventListener('click', function() {
            document.getElementById('newAddressForm').style.display = 'block';
        });
    </script>
</x-app-layout>