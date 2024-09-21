<div class="mt-6 space-y-4">
    <div class="flex items-center">
        <label for="postal_code" class="w-24 text-gray-600">郵便番号</label>
        <input type="text" id="postal_code" name="postal_code" required 
               class="border border-gray-300 focus:border-gray-500 focus:ring-0 rounded-md p-2 w-full">
    </div>
    <span class="flex justify-end text-gray-600 text-xs mb-4">※郵便番号で住所が自動入力されます。</span>
    <div class="flex items-center">
        <label for="prefecture" class="w-24 text-gray-600">都道府県</label>
        <input type="text" id="prefecture" name="prefecture" required 
               class="border border-gray-300 focus:border-gray-500 focus:ring-0 rounded-md p-2 w-full">
    </div>
    <div class="flex items-center">
        <label for="city" class="w-24 text-gray-600">市区町村</label>
        <input type="text" id="city" name="city" required 
               class="border border-gray-300 focus:border-gray-500 focus:ring-0 rounded-md p-2 w-full">
    </div>
    <div class="flex items-center">
        <label for="street_address" class="w-24 text-gray-600">住所</label>
        <input type="text" id="street_address" name="street_address" required 
               class="border border-gray-300 focus:border-gray-500 focus:ring-0 rounded-md p-2 w-full">
    </div>
    <div class="flex items-center">
        <label for="building" class="w-24 text-gray-600">建物名</label>
        <input type="text" id="building" name="building" 
               class="border border-gray-300 focus:border-gray-500 focus:ring-0 rounded-md p-2 w-full">
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-gray-700 text-white rounded-md px-4 py-2 hover:bg-gray-900">保存</button>
    </div>
</div>

<script>
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