<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800 pb-20">

    <!-- NAVBAR SIMPLE -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 p-4 sticky top-0 z-50">
        <div class="container mx-auto max-w-4xl flex justify-between items-center">
            <a href="<?= base_url('menu') ?>" class="flex items-center gap-2 text-gray-500 hover:text-red-600 transition font-semibold text-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Menu
            </a>
            <h1 class="text-xl font-black text-red-600 tracking-wider">SIJAYAM</h1>
        </div>
    </nav>

    <main class="container mx-auto px-4 pt-8 max-w-3xl">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Pesanan Saya</h2>
                <p class="text-gray-500 mt-1">Pantau status makanan lezat Anda di sini.</p>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl relative mb-6 font-bold shadow-sm flex items-center gap-2">
                <i class="bi bi-check-circle-fill text-xl"></i> <?= session()->getFlashdata('success') ?>
            </div>
            <script>localStorage.removeItem('sijayam_cart');</script>
        <?php endif; ?>

        <!-- EMPTY STATE JIKA BELUM ADA PESANAN -->
        <?php if(empty($orders)): ?>
            <div class="bg-white p-12 rounded-[2.5rem] shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center">
                <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                    <i class="bi bi-receipt text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-8 max-w-sm">Perut keroncongan? Yuk lihat menu spesial Sijayam dan buat pesanan pertama Anda sekarang!</p>
                <a href="<?= base_url('menu') ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-2xl transition shadow-lg shadow-red-600/30">
                    Lihat Menu Sijayam
                </a>
            </div>
        <?php endif; ?>

        <!-- DAFTAR PESANAN -->
        <div class="space-y-6">
            <?php foreach ($orders as $order): ?>
                
                <?php 
                    // Menentukan warna badge berdasarkan status
                    $statusColor = 'bg-yellow-100 text-yellow-700'; // Default Pending
                    $icon = 'bi-clock-history';
                    $progress = 1;

                    if ($order['status'] == 'Diproses') {
                        $statusColor = 'bg-blue-100 text-blue-700';
                        $icon = 'bi-fire';
                        $progress = 2;
                    } else if ($order['status'] == 'Selesai') {
                        $statusColor = 'bg-emerald-100 text-emerald-700';
                        $icon = 'bi-check2-all';
                        $progress = 3;
                    } else if ($order['status'] == 'Dibatalkan') {
                        $statusColor = 'bg-red-100 text-red-700';
                        $icon = 'bi-x-circle';
                        $progress = 0;
                    }
                ?>

                <!-- BENTO CARD PESANAN -->
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    
                    <!-- Header Card -->
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-6">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">ID Pesanan</span>
                            <p class="font-black text-xl text-gray-900">#ORD-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></p>
                            <p class="text-sm text-gray-500 mt-1"><i class="bi bi-calendar3"></i> <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                        </div>
                        <!-- Status Badge -->
                        <div class="font-bold px-4 py-2 rounded-xl text-sm flex items-center gap-2 <?= $statusColor ?>">
                            <i class="bi <?= $icon ?>"></i> <?= $order['status'] ?>
                        </div>
                    </div>

                    <!-- Visual Status Tracker (Progress Bar) -->
                    <?php if ($progress > 0): ?>
                    <div class="mb-8">
                        <div class="flex gap-2 h-2 mb-2">
                            <div class="flex-1 rounded-full <?= $progress >= 1 ? 'bg-red-600' : 'bg-gray-100' ?> transition-colors duration-500"></div>
                            <div class="flex-1 rounded-full <?= $progress >= 2 ? 'bg-red-600' : 'bg-gray-100' ?> transition-colors duration-500"></div>
                            <div class="flex-1 rounded-full <?= $progress >= 3 ? 'bg-emerald-500' : 'bg-gray-100' ?> transition-colors duration-500"></div>
                        </div>
                        <div class="flex justify-between text-[10px] sm:text-xs font-bold text-gray-400 uppercase">
                            <span class="<?= $progress >= 1 ? 'text-red-600' : '' ?>">Menunggu</span>
                            <span class="<?= $progress >= 2 ? 'text-red-600 text-center' : 'text-center' ?>">Dimasak</span>
                            <span class="<?= $progress >= 3 ? 'text-emerald-500 text-right' : 'text-right' ?>">Selesai</span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Rincian Total & Tombol Toggle Accordion -->
                    <div class="flex justify-between items-center py-4 border-t border-gray-100 border-dashed">
                        <div>
                            <span class="text-sm text-gray-500 block mb-1">Total Belanja</span>
                            <p class="font-black text-xl text-red-600">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></p>
                        </div>
                        
                        <button onclick="toggleDetails(<?= $order['id'] ?>)" id="btn-toggle-<?= $order['id'] ?>" class="text-sm font-bold text-gray-600 hover:text-red-600 transition flex items-center gap-1 bg-gray-50 px-4 py-2 rounded-xl">
                            Lihat Rincian <i class="bi bi-chevron-down transition-transform duration-300" id="icon-<?= $order['id'] ?>"></i>
                        </button>
                    </div>

                    <!-- Accordion Item List (Default Tersembunyi) -->
                    <div id="details-<?= $order['id'] ?>" class="hidden mt-4 pt-4 border-t border-gray-50 transition-all duration-300">
                        <h4 class="text-sm font-bold text-gray-900 mb-3">Daftar Makanan:</h4>
                        <ul class="space-y-3">
                            <?php foreach ($order['items'] as $item): ?>
                                <li class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-3">
                                        <span class="bg-gray-100 text-gray-700 font-bold px-2 py-1 rounded-lg text-xs"><?= $item['quantity'] ?>x</span>
                                        <span class="font-medium text-gray-700"><?= esc($item['name']) ?></span>
                                    </div>
                                    <span class="font-semibold text-gray-900">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Script untuk Accordion Interaktif -->
    <script>
        function toggleDetails(id) {
            const detailsDiv = document.getElementById('details-' + id);
            const icon = document.getElementById('icon-' + id);
            const btn = document.getElementById('btn-toggle-' + id);

            if (detailsDiv.classList.contains('hidden')) {
                // Buka rincian
                detailsDiv.classList.remove('hidden');
                icon.classList.add('rotate-180');
                btn.innerHTML = 'Tutup Rincian <i class="bi bi-chevron-up transition-transform duration-300" id="icon-' + id + '"></i>';
                btn.classList.replace('bg-gray-50', 'bg-red-50');
                btn.classList.replace('text-gray-600', 'text-red-600');
            } else {
                // Tutup rincian
                detailsDiv.classList.add('hidden');
                icon.classList.remove('rotate-180');
                btn.innerHTML = 'Lihat Rincian <i class="bi bi-chevron-down transition-transform duration-300" id="icon-' + id + '"></i>';
                btn.classList.replace('bg-red-50', 'bg-gray-50');
                btn.classList.replace('text-red-600', 'text-gray-600');
            }
        }
    </script>
</body>
</html>