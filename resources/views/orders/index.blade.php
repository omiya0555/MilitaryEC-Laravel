<x-app-layout>
    <div class="container mx-auto mt-12 p-6">
        @if($orders->isEmpty())
            <p class="text-center text-gray-500">購入履歴がありません。</p>
        
        @else
        
        <p class="flex justify-center text-gray-700 p-5">O R D E R S</p>

        <!-- flash message -->
        @include('components/flash')

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-800 text-white text-left">
                        <th class="px-6 py-3">日時</th>
                        <th class="px-6 py-3">合計金額</th>
                        <th class="px-6 py-3 w-3/5">購入商品</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-700 text-sm">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-gray-900 text-lg font-semibold">{{ number_format($order->total_amount) }}円</td>
                            <td class="px-6 py-4">
                                <table class="min-w-full bg-gray-50 border rounded-lg">
                                    <thead>
                                        <tr class="text-left bg-gray-200 text-gray-700">
                                            <th class="px-4 py-2">画像</th>
                                            <th class="px-4 py-2">商品名</th>
                                            <th class="px-4 py-2">価格</th>
                                            <th class="px-4 py-2">個数</th>
                                            <th class="px-4 py-2">配送状況</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300">
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="px-4 py-2">
                                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-20 h-20 object-cover rounded-md">
                                                </td>
                                                <td class="px-4 py-2 text-gray-700">{{ $item->name }}</td>
                                                <td class="px-4 py-2 text-gray-900">{{ number_format($item->price) }}円</td>
                                                <td class="px-4 py-2 text-gray-900">{{ $item->quantity }}</td>
                                                <td class="px-4 py-2">
                                                    @switch($order->status)
                                                        @case('pending')
                                                            <span class="text-yellow-600">未配送</span>
                                                            @break
                                                        @case('test')
                                                            <span class="text-blue-600">配送中</span>
                                                            @break
                                                        @case('test')
                                                            <span class="text-green-600">配送済</span>
                                                            @break
                                                        @case('test')
                                                            <span class="text-red-600">キャンセル</span>
                                                            @break
                                                        @default
                                                            <span class="text-gray-600">不明</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>
