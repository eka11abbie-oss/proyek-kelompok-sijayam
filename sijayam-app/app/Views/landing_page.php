<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sijayam - Pemesanan Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scroll-bar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 relative pb-24 overflow-x-hidden">

    <!-- NAVBAR -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 p-4 flex justify-between items-center fixed w-full top-0 z-40 transition-all">
        <h1 class="text-2xl font-black text-red-600 tracking-wider">SIJAYAM</h1>
        <div class="flex items-center gap-4">
            
            <!-- [DIUBAH] Tombol Keranjang sekarang memicu fungsi toggleCartDrawer() bukan link href -->
            <button onclick="toggleCartDrawer()" class="bg-red-50 text-red-600 font-bold px-4 py-2 rounded-2xl shadow-sm hover:bg-red-100 transition flex items-center gap-2 border border-red-100 cursor-pointer">
                <i class="bi bi-cart3 text-lg"></i>
                <span id="cart-count" class="bg-red-600 text-white px-2 py-0.5 rounded-xl text-xs">0</span>
            </button>
            
            <a href="<?= base_url('customer/orders') ?>" class="hidden md:block text-sm font-semibold text-gray-600 hover:text-red-600 transition">Pesanan Saya</a>
            <span class="hidden md:block text-gray-300">|</span>
            <span class="hidden md:flex text-sm font-bold text-gray-800 items-center gap-1">
                <i class="bi bi-person-circle text-red-500"></i> <?= esc(session()->get('customer_username')) ?>
            </span>
            <a href="<?= base_url('logout') ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-xl text-sm font-bold transition">
                <i class="bi bi-box-arrow-right md:hidden"></i> <span class="hidden md:inline">Logout</span>
            </a>
        </div>
    </nav>

    <!-- KONTEN UTAMA (Sama seperti sebelumnya) -->
    <main class="container mx-auto px-4 md:px-8 pt-24 max-w-6xl">
        
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl relative mb-6 font-bold text-center shadow-sm">
                <i class="bi bi-check-circle-fill mr-1"></i> <?= session()->getFlashdata('msg') ?>
            </div>
            <script>localStorage.removeItem('sijayam_cart');</script>
        <?php endif; ?>

        <!-- HERO PROMO -->
        <div class="relative bg-gradient-to-br from-red-600 to-red-700 text-white p-8 md:p-12 rounded-[2.5rem] shadow-xl overflow-hidden mb-8 group transition-all duration-300 hover:shadow-red-600/10">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
            <div class="absolute right-1/4 -top-20 w-40 h-40 bg-red-500/30 rounded-full blur-xl"></div>
            
            <div class="relative z-10 max-w-xl">
                <span class="bg-white/20 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full backdrop-blur-sm">🔥 Promo Spesial</span>
                <h2 class="text-3xl md:text-5xl font-black tracking-tight mt-4 mb-3 leading-tight">Makan Enak <br class="hidden md:block"> Nggak Pakai Mahal!</h2>
                <p class="text-red-100 text-sm md:text-base mb-6 font-medium">Dapatkan diskon kilat dan gratis ongkir khusus pemesanan akun baru Sijayam.</p>
            </div>

            <div class="absolute right-8 bottom-0 top-0 w-1/3 hidden md:flex items-center justify-center">
                <img src="/asset/Logasset .png" alt="Promo Aset" class="w-full h-4/5 object-cover rounded-3xl shadow-2xl transform rotate-3 group-hover:rotate-0 transition-transform duration-500 error-fallback">
            </div>
        </div>

        <!-- KATEGORI CHIPS -->
        <div class="mb-8" id="katalog-menu">
            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-tags text-red-600"></i> Pilih Kategori
            </h3>
            <div class="flex gap-3 overflow-x-auto pb-3 no-scrollbar snap-x">
                <button onclick="filterKategori('semua')" id="cat-semua" class="cat-btn snap-start px-5 py-2.5 rounded-2xl font-bold text-sm transition-all shadow-sm bg-red-600 text-white whitespace-nowrap">🍔 Semua Menu</button>
                <button onclick="filterKategori('ayam')" id="cat-ayam" class="cat-btn snap-start px-5 py-2.5 rounded-2xl font-bold text-sm transition-all shadow-sm bg-white text-gray-600 border border-gray-200 whitespace-nowrap">🍗 Ayam</button>
                <button onclick="filterKategori('nasi')" id="cat-nasi" class="cat-btn snap-start px-5 py-2.5 rounded-2xl font-bold text-sm transition-all shadow-sm bg-white text-gray-600 border border-gray-200 whitespace-nowrap">🍚 Nasi Goreng</button>
                <button onclick="filterKategori('minuman')" id="cat-minuman" class="cat-btn snap-start px-5 py-2.5 rounded-2xl font-bold text-sm transition-all shadow-sm bg-white text-gray-600 border border-gray-200 whitespace-nowrap">🍹 Minuman</button>
            </div>
        </div>

        <!-- KATALOG MENU GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="menu-container">
            <?php foreach ($menus as $menu): ?>
                <div class="menu-card bg-white p-4 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col justify-between group" data-category="<?= esc($menu['category'] ?? 'ayam') ?>">
                    <div>
                        <div class="w-full h-44 bg-gray-100 rounded-2xl overflow-hidden mb-4 relative">
                            <img src="<?= esc($menu['image_url']) ?>" alt="<?= esc($menu['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <h4 class="font-bold text-lg text-gray-900 mb-1 group-hover:text-red-600 transition-colors"><?= esc($menu['name']) ?></h4>
                        <p class="text-xs text-gray-400 mb-4 line-clamp-2 font-medium"><?= esc($menu['description']) ?></p>
                    </div>
                    
                    <div class="flex justify-between items-center pt-2 border-t border-gray-50">
                        <span class="font-black text-red-600 text-lg">Rp <?= number_format($menu['price'], 0, ',', '.') ?></span>
                        <button onclick="addToCart(<?= $menu['id'] ?>, '<?= esc($menu['name']) ?>', <?= $menu['price'] ?>)" 
                                class="bg-red-600 hover:bg-red-700 text-white p-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-red-600/20 active:scale-95 flex items-center gap-1">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- ========================================== -->
    <!-- KOMPONEN BARU: SIDEBAR SLIDER KERANJANG    -->
    <!-- ========================================== -->
    
    <!-- Background Gelap (Overlay) -->
    <div id="cart-overlay" onclick="toggleCartDrawer()" class="fixed inset-0 bg-black/60 z-50 hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>

    <!-- Panel Sidebar Kanan -->
    <div id="cart-drawer" class="fixed top-0 right-0 h-full w-full sm:w-[400px] bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl rounded-l-3xl">
        
        <!-- Header Laci -->
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <i class="bi bi-bag-check-fill text-red-600"></i> Keranjang Anda
            </h3>
            <button onclick="toggleCartDrawer()" class="text-gray-400 hover:text-red-600 transition-colors bg-gray-50 hover:bg-red-50 p-2 rounded-full">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Area Scroll Item Keranjang -->
        <div id="drawer-cart-items" class="flex-1 overflow-y-auto p-6 space-y-4 no-scrollbar">
            <!-- Item dirender via JS -->
        </div>

        <!-- Footer Ringkasan & Tombol -->
        <div class="p-6 border-t border-gray-100 bg-gray-50 rounded-bl-3xl">
            <div class="flex justify-between items-end mb-4">
                <span class="text-gray-600 font-bold">Total Pembayaran:</span>
                <span id="drawer-total" class="text-2xl font-black text-red-600">Rp 0</span>
            </div>
            
            <!-- Tombol Lanjut Checkout -->
            <a href="<?= base_url('checkout') ?>" id="drawer-checkout-btn" class="block w-full bg-red-600 hover:bg-red-700 text-center text-white py-4 rounded-2xl font-black text-lg transition-all shadow-xl shadow-red-600/30">
                Lanjut Checkout <i class="bi bi-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIKA -->
    <script>
        let cart = JSON.parse(localStorage.getItem('sijayam_cart')) || [];
        updateCartCount();

        // 1. Tambah ke Keranjang
        function addToCart(id, name, price) {
            let existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cart.push({ id: id, name: name, price: price, qty: 1 });
            }
            
            localStorage.setItem('sijayam_cart', JSON.stringify(cart));
            updateCartCount();
            
            // Animasi Tombol Sukses
            let btn = event.target.closest('button');
            let originalHTML = btn.innerHTML;
            btn.innerHTML = "<i class='bi bi-check-lg'></i> Sukses";
            btn.classList.replace('bg-red-600', 'bg-emerald-600');
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.replace('bg-emerald-600', 'bg-red-600');
            }, 800);

            // Update isi Sidebar jika sedang terbuka
            renderCartDrawer();
        }

        function updateCartCount() {
            let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cart-count').innerText = totalItems;
        }

        // 2. Buka / Tutup Sidebar Keranjang
        function toggleCartDrawer() {
            const drawer = document.getElementById('cart-drawer');
            const overlay = document.getElementById('cart-overlay');
            
            if (drawer.classList.contains('translate-x-full')) {
                // BUKA
                renderCartDrawer();
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                drawer.classList.remove('translate-x-full');
            } else {
                // TUTUP
                drawer.classList.add('translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // 3. Render Daftar Item di dalam Sidebar
        function renderCartDrawer() {
            let container = document.getElementById('drawer-cart-items');
            let totalEl = document.getElementById('drawer-total');
            let checkoutBtn = document.getElementById('drawer-checkout-btn');

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full text-center py-10 opacity-70">
                        <i class="bi bi-basket text-6xl text-gray-300 mb-4"></i>
                        <p class="font-bold text-gray-500">Keranjang masih kosong</p>
                        <p class="text-sm text-gray-400">Yuk, pilih menu lezat Sijayam!</p>
                    </div>`;
                totalEl.innerText = 'Rp 0';
                checkoutBtn.classList.add('pointer-events-none', 'opacity-50', 'bg-gray-400');
                checkoutBtn.classList.remove('bg-red-600', 'hover:bg-red-700', 'shadow-xl');
            } else {
                let html = '';
                let total = 0;
                
                cart.forEach(item => {
                    let sub = item.price * item.qty;
                    total += sub;
                    html += `
                        <div class="flex justify-between items-center bg-white border border-gray-100 p-4 rounded-2xl shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg font-black text-sm">
                                    ${item.qty}x
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900 text-sm leading-tight">${item.name}</h5>
                                    <span class="text-xs font-bold text-red-600">Rp ${sub.toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                            <button onclick="removeFromCart(${item.id})" class="text-gray-300 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
                totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
                checkoutBtn.classList.remove('pointer-events-none', 'opacity-50', 'bg-gray-400');
                checkoutBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'shadow-xl');
            }
        }

        // 4. Hapus Item dari Keranjang
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem('sijayam_cart', JSON.stringify(cart));
            updateCartCount();
            renderCartDrawer();
        }

        // 5. Filter Kategori (Visual)
        function filterKategori(kategori) {
            document.querySelectorAll('.cat-btn').forEach(btn => {
                btn.classList.remove('bg-red-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-600');
            });
            let activeBtn = document.getElementById('cat-' + kategori);
            activeBtn.classList.remove('bg-white', 'text-gray-600');
            activeBtn.classList.add('bg-red-600', 'text-white');

            let cards = document.querySelectorAll('.menu-card');
            cards.forEach(card => {
                let cardCategory = card.getAttribute('data-category');
                card.style.display = (kategori === 'semua' || cardCategory === kategori) ? 'flex' : 'none';
            });
        }
    </script>
</body>
</html>