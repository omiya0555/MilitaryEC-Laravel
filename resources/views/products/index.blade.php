<x-app-layout>
    <x-slider></x-slider>
    <hr class="mt-12 p-2"/>
    <p class="flex justify-center text-gray-700 mt-20 p-5">N E W</p>

    <div class="flex flex-wrap justify-center text-center gap-4 m-4 p-4">
        @foreach($products as $product)
            <div class="w-64 rounded overflow-hidden shadow-lg">
                <img src="{{ $product->image_path }}" style="width:100%; height:200px;">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                    <p class="text-gray-700 text-base">
                        {{ $product->description }}
                    </p>
                </div>
                <div class=" flex justify-between p-4">
                    <span class="bg-gray-200 w-24 h-10 flex justify-center items-center text-sm  text-gray-700">{{ $product->price }}</span>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf
                        <button type="submit" class="w-24 h-10 flex justify-center items-center border border-green-600 bg-green-700 hover:bg-green-800">
                            <span class="text-white items-center">
                                Add Item
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>