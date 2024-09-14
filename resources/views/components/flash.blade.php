<div>
    @if (session('success'))
        <div class="flex justify-center mt-12 p-4">
            <div class="bg-green-500 text-white text-center px-4 py-3 rounded shadow-lg w-1/2">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('failed'))
        <div class="flex justify-center mt-12">
            <div class="bg-red-500 text-white text-center px-4 py-3 rounded shadow-lg w-1/2">
                <strong>Error:</strong> {{ session('failed') }}
            </div>
        </div>
    @endif
</div>