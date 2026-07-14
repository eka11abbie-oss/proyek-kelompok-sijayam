<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pesanan - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800 pb-20">

    <!-- NAVBAR SIMPLE (Khusus halaman Checkout agar lebih fokus) -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 p-4 sticky top-0 z-50">
        <div class="container mx-auto max-w-5xl flex justify-between items-center">
            <a href="<?= base_url('menu') ?>" class="flex items-center gap-2 text-gray-500 hover:text-red-600 transition font-semibold text-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Menu
            </a>
            <h1 class="text-xl font-black text-red-600 tracking-wider">SIJAYAM</h1>
        </div>
    </nav>

    <main class="container mx-auto px-4 md:px-8 pt-8 max-w-5xl">
        
        <div class="mb-8">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Checkout Pesanan</h2>
            <p class="text-gray-500 mt-1">Pastikan pesanan Anda sudah benar sebelum mengonfirmasi.</p>
        </div>

        <!-- LAYOUT GRID 2 KOLOM (Kiri: Item, Kanan: Total) -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- KOLOM KIRI: Daftar Item Keranjang -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 md:p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <i class="bi bi-bag-check text-red-600"></i> Rincian Item
                    </h3>
                    
                    <div id="cart-items" class="flex flex-col">
                        <!-- Item keranjang akan di-render di sini oleh JavaScript -->
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: Ringkasan Total & Tombol Bayar -->
            <div class="w-full lg:w-1/3">
                <!-- Sticky agar tetap terlihat saat scroll ke bawah -->
                <div class="bg-red-50 rounded-[2rem] p-6 md:p-8 border border-red-100 sticky top-24 shadow-lg shadow-red-100/50">
                    <h3 class="text-lg font-bold text-red-900 mb-6">Ringkasan Pembayaran</h3>
                    
                    <div class="flex justify-between items-center mb-4 text-gray-600 font-medium">
                        <span>Subtotal Menu</span>
                        <span id="summary-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 text-gray-600 font-medium pb-6 border-b border-red-200 border-dashed">
                        <span>Biaya Layanan</span>
                        <span class="text-green-600 font-bold">Gratis</span>
                    </div>
                    
                    <div class="flex justify-between items-end mb-8">
                        <span class="text-gray-700 font-bold">Total Pembayaran</span>
                        <span id="grand-total" class="text-3xl font-black text-red-600 tracking-tight">Rp 0</span>
                    </div>

                    <form action="<?= base_url('checkout/process') ?>" method="POST" id="checkout-form">
                        <input type="hidden" name="cart_data" id="cart-data-input">
                        <input type="hidden" name="total_price" id="total-price-input">
                        
                        <button type="submit" id="btn-submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black text-lg transition-all transform active:scale-95 shadow-xl shadow-red-600/30 flex justify-center items-center gap-2">
                            Konfirmasi Pesanan <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- LOGIKA JAVASCRIPT KERANJANG -->
    <script>
        let cart = JSON.parse(localStorage.getItem('sijayam_cart')) || [];
        let cartContainer = document.getElementById('cart-items');
        let summarySubtotalElement = document.getElementById('summary-subtotal');
        let grandTotalElement = document.getElementById('grand-total');
        let formInputCart = document.getElementById('cart-data-input');
        let formInputTotal = document.getElementById('total-price-input');
        let btnSubmit = document.getElementById('btn-submit');

        if (cart.length === 0) {
            // TAMPILAN JIKA KERANJANG KOSONG
            cartContainer.innerHTML = `
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-4 text-gray-300">
                        <i class="bi bi-cart-x text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-700 mb-2">Keranjang Kosong</h4>
                    <p class="text-gray-500 mb-6">Anda belum menambahkan menu apapun.</p>
                    <a href="<?= base_url('menu') ?>" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-xl transition">Cari Makanan</a>
                </div>
            `;
            btnSubmit.disabled = true;
            btnSubmit.classList.replace('bg-red-600', 'bg-gray-300');
            btnSubmit.classList.replace('hover:bg-red-700', 'hover:bg-gray-300');
            btnSubmit.classList.remove('shadow-xl', 'shadow-red-600/30');
            btnSubmit.innerText = "Keranjang Kosong";
        } else {
            // TAMPILAN JIKA ADA BARANG DI KERANJANG
            let total = 0;
            let html = '';

            cart.forEach(item => {
                let subtotal = item.price * item.qty;
                total += subtotal;
                
                html += `
                    <div class="flex justify-between items-center py-4 border-b border-gray-50 last:border-0">
                        <div class="flex items-center gap-4">
                            <!-- Indikator Kuantitas yang Cantik -->
                            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center font-black">
                                ${item.qty}x
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">${item.name}</h4>
                                <p class="text-sm text-gray-500">Rp ${item.price.toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                        <span class="font-bold text-gray-900">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            });

            cartContainer.innerHTML = html;
            summarySubtotalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');
            grandTotalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');

            // Masukkan data ke form hidden
            formInputCart.value = JSON.stringify(cart);
            formInputTotal.value = total;
        }
    </script>
</body>
</html>