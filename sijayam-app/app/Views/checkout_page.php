<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-orange-500 p-6 text-white text-center">
            <h1 class="text-3xl font-bold">Ringkasan Pesanan</h1>
        </div>

        <div class="p-8">
            <div id="cart-items" class="mb-8">
                </div>

            <div class="border-t-2 border-dashed border-gray-300 pt-4 mb-8 flex justify-between items-center">
                <span class="text-xl font-bold text-gray-700">Total Pembayaran:</span>
                <span id="grand-total" class="text-2xl font-bold text-orange-600">Rp 0</span>
            </div>

            <form action="/checkout/process" method="POST" id="checkout-form">
                <input type="hidden" name="cart_data" id="cart-data-input">
                <input type="hidden" name="total_price" id="total-price-input">
                
                <div class="flex gap-4">
                    <a href="/" class="w-1/3 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-bold hover:bg-gray-300 transition">Kembali</a>
                    <button type="submit" id="btn-submit" class="w-2/3 bg-green-500 text-white py-3 rounded-lg font-bold text-lg hover:bg-green-600 transition shadow-lg">
                        Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Membaca data keranjang dari Local Storage
        let cart = JSON.parse(localStorage.getItem('sijayam_cart')) || [];
        let cartContainer = document.getElementById('cart-items');
        let grandTotalElement = document.getElementById('grand-total');
        let formInputCart = document.getElementById('cart-data-input');
        let formInputTotal = document.getElementById('total-price-input');
        let btnSubmit = document.getElementById('btn-submit');

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-center text-gray-500 my-10 text-lg">Keranjang Anda masih kosong.</p>';
            btnSubmit.disabled = true;
            btnSubmit.classList.replace('bg-green-500', 'bg-gray-400');
        } else {
            let total = 0;
            let html = '';

            cart.forEach(item => {
                let subtotal = item.price * item.qty;
                total += subtotal;
                
                html += `
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">${item.name}</h4>
                            <p class="text-sm text-gray-500">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</p>
                        </div>
                        <span class="font-bold text-gray-700">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            });

            cartContainer.innerHTML = html;
            grandTotalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');

            // Masukkan data ke input hidden agar bisa dikirim lewat form POST ke CI4
            formInputCart.value = JSON.stringify(cart);
            formInputTotal.value = total;
        }
    </script>
</body>
</html>