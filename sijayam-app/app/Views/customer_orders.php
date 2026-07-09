<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-orange-600"><a href="/">Sijayam</a></h1>
        <div class="flex gap-4 items-center">
            <a href="/" class="text-gray-600 hover:text-orange-500 font-semibold">Kembali ke Menu</a>
            <a href="/customer/logout" class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200 text-sm font-bold">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto p-8 max-w-4xl">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Status Pesanan Saya</h2>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 font-bold">
                <?= session()->getFlashdata('success') ?>
            </div>
            <script>localStorage.removeItem('sijayam_cart');</script>
        <?php endif; ?>

        <?php if(empty($orders)): ?>
            <div class="bg-white p-8 rounded-lg shadow text-center">
                <p class="text-gray-500 mb-4">Anda belum memiliki riwayat pesanan.</p>
                <a href="/" class="bg-orange-500 text-white px-4 py-2 rounded shadow font-bold">Pesan Sekarang</a>
            </div>
        <?php endif; ?>

        <div class="space-y-6">
            <?php foreach ($orders as $order): ?>
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 
                    <?= $order['status'] == 'Selesai' ? 'border-green-500' : ($order['status'] == 'Dibatalkan' ? 'border-red-500' : 'border-orange-500') ?>">
                    <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <div>
                            <p class="font-bold text-gray-800">#ORD-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></p>
                            <p class="text-sm text-gray-500"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                        </div>
                        <div class="font-bold px-3 py-1 rounded 
                            <?= $order['status'] == 'Selesai' ? 'bg-green-100 text-green-700' : ($order['status'] == 'Dibatalkan' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') ?>">
                            <?= $order['status'] ?>
                        </div>
                    </div>
                    <ul class="mb-4 space-y-2">
                        <?php foreach ($order['items'] as $item): ?>
                            <li class="flex justify-between text-gray-700">
                                <span><?= esc($item['name']) ?> (x<?= $item['quantity'] ?>)</span>
                                <span>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="text-right border-t pt-4">
                        <p class="font-bold text-lg text-gray-800">Total: Rp <?= number_format($order['total_price'], 0, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>