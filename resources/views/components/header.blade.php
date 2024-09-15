<header class="bg-white shadow-md py-2 px-6 fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <!-- 左側：サイトタイトル -->
        <a href="{{ route('products.index') }}">
            <div class="text-2xl font-semibold text-gray-700">
                    Militaly EC
            </div>
        </a>

        <!-- 右側：アイコン -->
        <div class="flex space-x-4">
            <!-- カートアイコン -->
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </a>
            <!-- ユーザーアイコン -->
            <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <a href="#" class="text-gray-600 hover:text-gray-800" onclick="confirmLogout(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                </a>
            </form>

            <script>
                function confirmLogout(event) {
                    event.preventDefault(); // デフォルトのリンク動作を無効にする
                    if (confirm("ログアウトしてもよろしいですか？")) {
                        document.getElementById('logout-form').submit(); // 「はい」が押されたらログアウトフォームを送信
                    }
                }
            </script>
        </div>
    </div>
</header>