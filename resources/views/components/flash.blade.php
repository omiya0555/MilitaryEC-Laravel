<div>
    @if (session('success'))
        <div class="flex justify-center p-4">
            <div class="bg-green-500 text-white text-center px-4 py-3 rounded shadow-lg w-1/2">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="flex justify-center p-4">
            <div class="bg-red-500 text-white text-center px-4 py-3 rounded shadow-lg w-1/2">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        </div>
    @endif
</div>