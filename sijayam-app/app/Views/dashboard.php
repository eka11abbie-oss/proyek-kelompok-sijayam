<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .modal-active { overflow: hidden; }
    </style>
</head>
<body class="text-gray-800 pb-20">

    <!-- NAVBAR ADMIN -->
    <nav class="bg-gray-900 shadow-lg p-4 sticky top-0 z-40">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <h1 class="text-2xl font-black text-red-500 tracking-wider">ADMIN SIJAYAM</h1>
                
                <div class="hidden md:flex gap-2">
                    <a href="<?= base_url('dashboard') ?>" class="bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md shadow-red-600/30 transition">
                        <i class="bi bi-box-seam mr-1"></i> Kelola Menu
                    </a>
                    <a href="<?= base_url('dashboard/orders') ?>" class="text-gray-400 hover:text-white hover:bg-gray-800 px-4 py-2 rounded-xl text-sm font-semibold transition">
                        <i class="bi bi-receipt mr-1"></i> Pesanan Masuk
                    </a>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-bold text-gray-300 hidden md:block">
                    <i class="bi bi-shield-lock-fill text-red-500"></i> Mode Admin
                </span>
                <a href="<?= base_url('logout') ?>" class="bg-gray-800 hover:bg-red-600 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-sm font-bold transition-all">
                    Logout <i class="bi bi-box-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- MENU NAVIGASI MOBILE -->
    <div class="md:hidden bg-gray-800 flex justify-center gap-2 p-3 shadow-inner">
        <a href="<?= base_url('dashboard') ?>" class="bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg shadow-md">Kelola Menu</a>
        <a href="<?= base_url('dashboard/orders') ?>" class="text-gray-400 text-xs font-bold px-4 py-2 rounded-lg">Pesanan Masuk</a>
    </div>

    <main class="container mx-auto px-4 pt-8">
        
        <!-- Header & Tombol Tambah Menu -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-200 pb-6">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Katalog Menu</h2>
                <p class="text-gray-500 mt-1">Kelola daftar makanan dan minuman yang tersedia untuk pelanggan.</p>
            </div>
            
            <button onclick="toggleModal('modal-add')" class="bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-2xl font-bold text-sm transition-all transform active:scale-95 shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                <i class="bi bi-plus-lg text-lg"></i> Tambah Menu Baru
            </button>
        </div>

        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 px-6 py-4 rounded-r-2xl relative mb-8 font-bold shadow-sm flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-2xl"></i> <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <!-- GRID DAFTAR MENU -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php if(!empty($menus)): ?>
                <?php foreach ($menus as $menu): ?>
                    <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group">
                        <div>
                            <!-- Foto Menu -->
                            <div class="w-full h-40 bg-gray-100 rounded-2xl overflow-hidden mb-4 relative">
                                <img src="<?= esc($menu['image_url']) ?>" alt="Menu" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-black/70 text-white text-[10px] font-bold px-2 py-1 rounded-lg backdrop-blur-sm uppercase">
                                    <?= esc($menu['category'] ?? 'UMUM') ?>
                                </span>
                            </div>
                            <h4 class="font-bold text-lg text-gray-900 mb-1"><?= esc($menu['name']) ?></h4>
                            <p class="font-black text-red-600 mb-4">Rp <?= number_format($menu['price'], 0, ',', '.') ?></p>
                        </div>
                        
                        <!-- Aksi Edit & Hapus -->
                        <div class="flex gap-2 pt-3 border-t border-gray-50">
                            <!-- Tombol Edit (Bisa dikembangkan menjadi modal edit nanti) -->
                            <a href="<?= base_url('dashboard/edit/' . $menu['id']) ?>" class="flex-1 bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-600 py-2.5 rounded-xl font-bold text-xs text-center transition">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <a href="<?= base_url('dashboard/delete/' . $menu['id']) ?>" onclick="return confirm('Yakin ingin menghapus menu ini?');" class="flex-1 bg-gray-50 hover:bg-red-50 text-gray-600 hover:text-red-600 py-2.5 rounded-xl font-bold text-xs text-center transition">
                                <i class="bi bi-trash3"></i> Hapus
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <i class="bi bi-journal-x text-6xl text-gray-300 mb-4 block"></i>
                    <p class="font-bold text-gray-500">Belum ada menu yang ditambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- ========================================== -->
    <!-- MODAL POP-UP TAMBAH MENU BARU              -->
    <!-- ========================================== -->
    <div id="modal-add" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Overlay Hitam Transparan -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('modal-add')"></div>
        
        <!-- Konten Modal -->
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="relative bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg w-full border border-gray-100">
                
                <!-- Header Modal -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-black text-gray-900 flex items-center gap-2">
                        <i class="bi bi-plus-circle-fill text-red-600"></i> Tambah Menu Baru
                    </h3>
                    <button onclick="toggleModal('modal-add')" class="text-gray-400 hover:text-red-600 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                
                <!-- Form Tambah Menu -->
                <form action="<?= base_url('dashboard/create/process') ?>" method="POST" class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nama Menu</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" placeholder="Misal: Ayam Bakar Spesial">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Harga (Rp)</label>
                                <input type="number" name="price" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" placeholder="25000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                                <select name="category" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all">
                                    <option value="ayam">Ayam</option>
                                    <option value="nasi">Nasi Goreng</option>
                                    <option value="minuman">Minuman</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Link Gambar (URL)</label>
                            <input type="text" name="image_url" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" placeholder="https://example.com/gambar.jpg">
                            <p class="text-[10px] text-gray-400 mt-1">*Masukkan URL gambar untuk sementara (contoh dari Unsplash)</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Makanan</label>
                            <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" placeholder="Deskripsikan kelezatannya..."></textarea>
                        </div>
                    </div>

                    <!-- Footer Modal -->
                    <div class="mt-8 flex gap-3">
                        <button type="button" onclick="toggleModal('modal-add')" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition">
                            Batal
                        </button>
                        <button type="submit" class="w-2/3 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-red-600/30 transition">
                            Simpan Menu
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script Tampilkan/Sembunyikan Modal -->
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            modal.classList.toggle('hidden');
            document.body.classList.toggle('modal-active');
        }
    </script>
</body>
</html>