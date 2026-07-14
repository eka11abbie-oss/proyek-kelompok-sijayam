<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Admin Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="text-gray-800 pb-20">

    <!-- NAVBAR ADMIN (Tema Gelap Profesional) -->
    <nav class="bg-gray-900 shadow-lg p-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <h1 class="text-2xl font-black text-red-500 tracking-wider">ADMIN SIJAYAM</h1>
                
                <!-- Tab Navigasi Admin -->
                <div class="hidden md:flex gap-2">
                    <a href="<?= base_url('dashboard') ?>" class="text-gray-400 hover:text-white hover:bg-gray-800 px-4 py-2 rounded-xl text-sm font-semibold transition">
                        <i class="bi bi-box-seam mr-1"></i> Kelola Menu
                    </a>
                    <a href="<?= base_url('dashboard/orders') ?>" class="bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md shadow-red-600/30 transition">
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

    <!-- MENU NAVIGASI MOBILE (Muncul di HP saja) -->
    <div class="md:hidden bg-gray-800 flex justify-center gap-2 p-3 shadow-inner">
        <a href="<?= base_url('dashboard') ?>" class="text-gray-400 text-xs font-bold px-4 py-2 rounded-lg">Kelola Menu</a>
        <a href="<?= base_url('dashboard/orders') ?>" class="bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg shadow-md">Pesanan Masuk</a>
    </div>

    <main class="container mx-auto px-4 pt-8">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Pesanan Pelanggan</h2>
                <p class="text-gray-500 mt-1">Pantau dan proses pesanan masuk secara real-time.</p>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 px-6 py-4 rounded-r-2xl relative mb-8 font-bold shadow-sm flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-2xl"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- KANBAN GRID CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($orders as $order): ?>
                
                <?php 
                    // Menentukan tema visual berdasarkan status pesanan
                    $cardStyle = 'bg-white border-gray-100'; 
                    $badgeStyle = 'bg-yellow-100 text-yellow-700'; 
                    $icon = 'bi-exclamation-circle-fill';
                    
                    if ($order['status'] == 'Diproses') {
                        $cardStyle = 'bg-blue-50 border-blue-100 ring-2 ring-blue-500/20';
                        $badgeStyle = 'bg-blue-600 text-white shadow-md shadow-blue-500/30';
                        $icon = 'bi-fire';
                    } else if ($order['status'] == 'Selesai') {
                        $cardStyle = 'bg-gray-50 border-gray-200 opacity-75';
                        $badgeStyle = 'bg-emerald-100 text-emerald-700';
                        $icon = 'bi-check-all';
                    } else if ($order['status'] == 'Dibatalkan') {
                        $cardStyle = 'bg-red-50 border-red-100 opacity-75';
                        $badgeStyle = 'bg-red-100 text-red-700';
                        $icon = 'bi-x-circle-fill';
                    }
                ?>

                <!-- ACTION CARD -->
                <div class="rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border p-6 flex flex-col justify-between <?= $cardStyle ?>">
                    
                    <div>
                        <!-- Header Kartu -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">ID: #ORD-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                <span class="text-sm text-gray-500 font-medium"><i class="bi bi-clock"></i> <?= date('H:i', strtotime($order['created_at'])) ?> WIB</span>
                            </div>
                            <div class="px-3 py-1.5 rounded-xl text-xs font-black flex items-center gap-1 <?= $badgeStyle ?>">
                                <i class="bi <?= $icon ?>"></i> <?= strtoupper($order['status']) ?>
                            </div>
                        </div>

                        <!-- Info Pelanggan & Total -->
                        <div class="mb-4 bg-white/60 p-4 rounded-2xl">
                            <p class="text-xs text-gray-500 mb-1">Total Tagihan</p>
                            <p class="text-2xl font-black text-gray-900">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></p>
                        </div>

                        <!-- Rincian Item Ringkas -->
                        <div class="mb-6">
                            <p class="text-xs font-bold text-gray-900 mb-2 border-b border-gray-200/50 pb-2">Rincian Item:</p>
                            <ul class="space-y-2">
                                <?php 
                                // Tampilkan maksimal 3 item agar kartu tidak terlalu panjang
                                $itemCount = 0;
                                foreach ($order['items'] as $item): 
                                    if ($itemCount < 3):
                                ?>
                                    <li class="flex justify-between items-center text-sm">
                                        <span class="font-medium text-gray-700 line-clamp-1"><span class="font-bold text-red-600 mr-1"><?= $item['quantity'] ?>x</span> <?= esc($item['name']) ?></span>
                                    </li>
                                <?php 
                                    endif;
                                    $itemCount++;
                                endforeach; 
                                ?>
                                
                                <?php if (count($order['items']) > 3): ?>
                                    <li class="text-xs font-bold text-gray-400 italic mt-2">+ <?= count($order['items']) - 3 ?> item lainnya...</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- AREA TOMBOL AKSI (1-Click Action) -->
                    <div class="mt-4 pt-4 border-t border-gray-200/50">
                        <?php if ($order['status'] == 'Pending'): ?>
                            <div class="flex gap-2">
                                <!-- Tombol Proses (Utama) -->
                                <form action="<?= base_url('dashboard/orders/update/' . $order['id']) ?>" method="POST" class="flex-1">
                                    <input type="hidden" name="status" value="Diproses">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition-all transform active:scale-95 shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2">
                                        <i class="bi bi-fire"></i> Mulai Masak
                                    </button>
                                </form>
                                <!-- Tombol Batal -->
                                <form action="<?= base_url('dashboard/orders/update/' . $order['id']) ?>" method="POST" class="w-1/3">
                                    <input type="hidden" name="status" value="Dibatalkan">
                                    <button type="submit" class="w-full bg-gray-100 hover:bg-red-100 hover:text-red-600 text-gray-600 py-3 rounded-xl font-bold text-sm transition-all flex items-center justify-center">
                                        Batal
                                    </button>
                                </form>
                            </div>
                        
                        <?php elseif ($order['status'] == 'Diproses'): ?>
                            <!-- Tombol Selesai (Utama) -->
                            <form action="<?= base_url('dashboard/orders/update/' . $order['id']) ?>" method="POST">
                                <input type="hidden" name="status" value="Selesai">
                                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-black text-sm transition-all transform active:scale-95 shadow-lg shadow-emerald-500/30 flex items-center justify-center gap-2">
                                    <i class="bi bi-check2-circle text-lg"></i> Tandai Selesai
                                </button>
                            </form>
                        
                        <?php else: ?>
                            <!-- State Disable untuk pesanan yang sudah rampung -->
                            <button disabled class="w-full bg-gray-100 text-gray-400 py-3 rounded-xl font-bold text-sm cursor-not-allowed">
                                Riwayat Tersimpan
                            </button>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <?php if(empty($orders)): ?>
            <div class="text-center py-20">
                <i class="bi bi-inbox text-6xl text-gray-300 mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-400">Belum ada pesanan masuk.</h3>
            </div>
        <?php endif; ?>

    </main>
</body>
</html>