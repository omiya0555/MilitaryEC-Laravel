document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateTotalAmount() {
        let totalAmount = 0;

        // 各行の価格を取得して合計
        document.querySelectorAll('tbody tr').forEach(row => {
            const quantity = parseInt(row.querySelector('.quantity').innerText);
            const price = parseInt(row.querySelector('.price').innerText.replace('円', '').replace(',', ''));
            totalAmount += price;  // 数量を考慮して合計を計算
        });

        // 合計金額を表示
        document.getElementById('total-amount').innerText = `合計金額 : ${totalAmount.toLocaleString()}円`;
    }

    // 数量を減らすボタン
    document.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.id;
            fetch(`/cart/${cartId}/decrease`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cart_id: cartId })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // 数量と価格を更新
                      document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
                      document.getElementById(`price-${cartId}`).innerText = `${data.price.toLocaleString()}円`;

                      // 合計金額の更新
                      updateTotalAmount();

                      // カート数の更新
                      updateCartCount();
                  }
              });
        });
    });

    // 数量を増やすボタン
    document.querySelectorAll('.increase-btn').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.id;
            fetch(`/cart/${cartId}/increase`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cart_id: cartId })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // 数量と価格を更新
                      document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
                      document.getElementById(`price-${cartId}`).innerText = `${data.price.toLocaleString()}円`;

                      // 合計金額の更新
                      updateTotalAmount();

                      // カート数の更新
                      updateCartCount();
                  }
              });
        });
    });

    // 初期の合計金額の設定（ページロード時）
    updateTotalAmount();

    // カート数の更新
    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.count;
            });
    }

    // ページロード時にカート数を設定
    updateCartCount();
});

// document.addEventListener('DOMContentLoaded', function () {
//     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//     function updateTotalAmount() {
//         let totalAmount = 0;

//         // 各行の価格を取得して合計
//         document.querySelectorAll('tbody tr').forEach(row => {
//             console.log(row);
//             const quantity = parseInt(row.querySelector('.quantity').innerText);
            
//             const price = parseInt(row.querySelector('.price').innerText.replace('円', '').replace(',', ''));
//             totalAmount += price;
//         });

//         // 合計金額を表示
//         console.log(totalAmount);
//         document.getElementById('total-amount').innerText = `合計金額 : ${totalAmount.toLocaleString()}円`;
//     }

//     // 数量を減らすボタン
//     document.querySelectorAll('.decrease-btn').forEach(button => {
//         button.addEventListener('click', function () {
//             const cartId = this.dataset.id;
//             fetch(`/cart/${cartId}/decrease`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrfToken,
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ cart_id: cartId })
//             }).then(response => response.json())
//               .then(data => {
//                   if (data.success) {
//                       // 数量と価格を更新
//                       document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
//                       document.getElementById(`price-${cartId}`).innerText = `${data.price}円`;

//                       // 合計金額の更新
//                       updateTotalAmount();
//                   }
//               });
//         });
//     });

//     // 数量を増やすボタン
//     document.querySelectorAll('.increase-btn').forEach(button => {
//         button.addEventListener('click', function () {
//             const cartId = this.dataset.id;
//             fetch(`/cart/${cartId}/increase`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrfToken,
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ cart_id: cartId })
//             }).then(response => response.json())
//               .then(data => {
//                   if (data.success) {
//                       // 数量と価格を更新
//                       document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
//                       document.getElementById(`price-${cartId}`).innerText = `${data.price}円`;

//                       // 合計金額の更新
//                       updateTotalAmount();
//                   }
//               });
//         });
//     });

//     // 初期の合計金額の設定（ページロード時）
//     updateTotalAmount();


//     function updateCartCount() {
//         fetch('/cart/count')
//             .then(response => response.json())
//             .then(data => {
//                 document.getElementById('cart-count').innerText = data.count;
//             });
//     }

//     // カートにアイテムを追加したらカート数を更新
//     document.querySelectorAll('.increase-btn').forEach(button => {
//         button.addEventListener('click', function () {
//             const cartId = this.dataset.id;
//             fetch(`/cart/${cartId}/increase`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrfToken,
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ cart_id: cartId })
//             }).then(response => response.json())
//               .then(data => {
//                   if (data.success) {
//                       updateCartCount();  // カート数を更新
//                   }
//               });
//         });
//     });

//     document.querySelectorAll('.decrease-btn').forEach(button => {
//         button.addEventListener('click', function () {
//             const cartId = this.dataset.id;
//             fetch(`/cart/${cartId}/decrease`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrfToken,
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ cart_id: cartId })
//             }).then(response => response.json())
//               .then(data => {
//                   if (data.success) {
//                       updateCartCount();  // カート数を更新
//                   }
//               });
//         });
//     });

//     // ページロード時にカート数を設定
//     updateCartCount();


// });