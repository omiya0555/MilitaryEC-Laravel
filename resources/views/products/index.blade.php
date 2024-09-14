<x-app-layout>

    <h1 class="d-flex justify-content-center mt-12">商品一覧</h1>



    <!-- スライドショーの表示 -->
    <x-slider></x-slider>


    <div class="flex flex-wrap justify-center text-center gap-4 m-4 p-4">

        @foreach($products as $product)
            <div class=" w-64 rounded overflow-hidden shadow-lg">
                <img src="{{ $product->image_path }}" style="width:100%; height:200px;">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                    <p class="text-gray-700 text-base">
                        {{ $product->description }}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$product->price}}</span>
                    <span class="inline-block bg-gray-200 px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">add to cart</span>
                </div>
            </div>
        @endforeach

    </div>

</x-app-layout>
