<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-64 bg-white shadow-md">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-orange-600">Sijayam Admin</h2>
        </div>
        <nav class="mt-6">
            <a href="/dashboard" class="block py-3 px-6 text-gray-600 hover:bg-gray-50">Menu Makanan</a>
            <a href="/dashboard/orders" class="block py-3 px-6 bg-orange-50 text-orange-600 font-semibold border-r-4 border-orange-500">Pesanan Masuk</a>
            <a href="/logout" class="block py-3 px-6 text-red-500 hover:bg-red-50 mt-8">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Pesanan Masuk</h1>
            <p class="text-gray-600 mt-2">Pantau dan perbarui status pesanan pelanggan di sini.</p>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">ID & Waktu</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Rincian Item</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Total Harga</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($orders)): ?>
                        <tr><td colspan="4" class="px-5 py-5 text-center text-gray-500">Belum ada pesanan masuk.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="font-bold text-gray-800">#ORD-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></p>
                            <p class="text-sm font-semibold text-blue-600 mt-1">👤 <?= esc($order['username']) ?></p>
                            <p class="text-gray-500 text-xs mt-1"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-700">
                            <ul class="list-disc pl-4">
                                <?php foreach ($order['items'] as $item): ?>
                                    <li><?= esc($item['name']) ?> <span class="font-bold">(x<?= $item['quantity'] ?>)</span></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-orange-600">
                            Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <form action="/dashboard/orders/update/<?= $order['id'] ?>" method="POST" class="flex items-center gap-2">
                                <select name="status" class="border rounded px-2 py-1 focus:outline-none focus:border-orange-500 font-semibold
                                    <?php 
                                        if($order['status'] == 'Pending') echo 'text-yellow-600';
                                        elseif($order['status'] == 'Diproses') echo 'text-blue-600';
                                        elseif($order['status'] == 'Selesai') echo 'text-green-600';
                                        else echo 'text-red-600';
                                    ?>
                                ">
                                    <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Diproses" <?= $order['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option value="Selesai" <?= $order['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Dibatalkan" <?= $order['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                </select>
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-xs font-bold text-gray-700 transition">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>