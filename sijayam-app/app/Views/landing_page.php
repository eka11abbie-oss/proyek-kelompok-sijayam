<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sijayam - Pemesanan Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 relative pb-20">

    <nav class="bg-white shadow-md p-4 flex justify-between items-center fixed w-full top-0 z-50">
    <h1 class="text-2xl font-bold text-orange-600">Sijayam</h1>
    <div class="flex items-center gap-4">
        <a href="/checkout" class="bg-yellow-400 text-yellow-900 font-bold px-4 py-2 rounded shadow hover:bg-yellow-500 flex items-center">
            🛒 <span id="cart-count" class="ml-2 bg-white px-2 py-0.5 rounded-full text-xs">0</span>
        </a>
        
        <a href="/customer/orders" class="text-sm font-bold text-gray-700 hover:text-orange-500">Pesanan Saya</a>
        <span class="text-sm text-gray-400">|</span>
        <span class="text-sm font-bold text-orange-600">Hai, <?= esc(session()->get('customer_username')) ?></span>
        
        <a href="/logout" class="bg-gray-100 text-gray-600 px-3 py-1 rounded shadow hover:bg-gray-200 text-sm font-semibold">Logout</a>
    </div>
</nav>

    <header class="text-center py-24 bg-orange-100 mt-12">
        <h2 class="text-4xl font-extrabold mb-4">Lapar? Pesan di Sijayam Aja!</h2>
        <p class="text-lg text-gray-600">Makanan enak, harga bersahabat, langsung diantar.</p>
    </header>

    <main class="container mx-auto p-8">
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 font-bold text-center">
                <?= session()->getFlashdata('msg') ?>
            </div>
            <script>localStorage.removeItem('sijayam_cart');</script>
        <?php endif; ?>

        <h3 class="text-2xl font-bold mb-6 border-b-2 border-orange-500 inline-block">Menu Pilihan Kami</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($menus as $menu): ?>
                <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-full h-40 bg-gray-200 rounded-md mb-4 flex items-center justify-center text-gray-500">
                        <?= esc($menu['image_url']) ?>
                    </div>
                    <h4 class="font-bold text-xl mb-2"><?= esc($menu['name']) ?></h4>
                    <p class="text-sm text-gray-600 mb-4"><?= esc($menu['description']) ?></p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-orange-600 text-lg">Rp <?= number_format($menu['price'], 0, ',', '.') ?></span>
                        
                        <button onclick="addToCart(<?= $menu['id'] ?>, '<?= esc($menu['name']) ?>', <?= $menu['price'] ?>)" 
                                class="bg-green-500 text-white px-3 py-1 rounded font-semibold text-sm hover:bg-green-600 transition shadow">
                            + Keranjang
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
    
    let cart = JSON.parse(localStorage.getItem('sijayam_cart')) || [];
    updateCartCount();

    function addToCart(id, name, price) {
        // [BARU] Pengecekan Login
        if (!isCustomerLoggedIn) {
            document.getElementById('loginModal').classList.remove('hidden');
            return; // Hentikan proses masuk keranjang
        }

        let existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            cart.push({ id: id, name: name, price: price, qty: 1 });
        }
        
        localStorage.setItem('sijayam_cart', JSON.stringify(cart));
        updateCartCount();
        
        let btn = event.target;
        let originalText = btn.innerText;
        btn.innerText = "✓ Ditambahkan";
        btn.classList.replace('bg-green-500', 'bg-blue-500');
        setTimeout(() => {
            btn.innerText = originalText;
            btn.classList.replace('bg-blue-500', 'bg-green-500');
        }, 1000);
    }

    function updateCartCount() {
        let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        document.getElementById('cart-count').innerText = totalItems;
    }

    function closeModal() {
        document.getElementById('loginModal').classList.add('hidden');
    }
</script>
    </script>
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl text-center max-w-sm w-full mx-4">
        <h3 class="text-2xl font-bold mb-4 text-gray-800">Ups, Tunggu Dulu!</h3>
        <p class="text-gray-600 mb-6">Anda harus masuk atau mendaftar akun terlebih dahulu untuk mulai memesan makanan.</p>
        <div class="flex flex-col gap-3">
            <a href="/customer/login" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">Login Sekarang</a>
            <a href="/customer/register" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded hover:bg-gray-300">Buat Akun Baru</a>
            <button onclick="closeModal()" class="text-sm text-gray-400 mt-2 hover:text-gray-600">Tutup</button>
        </div>
    </div>
</div>
</body>
</html>