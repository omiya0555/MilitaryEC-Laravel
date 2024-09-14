document.addEventListener('DOMContentLoaded', function () {
    // 数量を減らすボタン
    document.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.id;
            fetch(`/cart/${cartId}/decrease`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`quantity-${cartId}`).innerText = data.quantity;
                }
            });
        });
    });
});