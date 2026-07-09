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
            <a href="/dashboard" class="block py-3 px-6 bg-orange-50 text-orange-600 font-semibold border-r-4 border-orange-500">Menu Makanan</a>
            <a href="/dashboard/orders" class="block py-3 px-6 text-gray-600 hover:bg-gray-50">Pesanan Masuk</a>
            <a href="/logout" class="block py-3 px-6 text-red-500 hover:bg-red-50 mt-8">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Menu</h1>
            <a href="/dashboard/create" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded shadow font-semibold">
                + Tambah Menu Baru
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Menu</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold">
                            <?= esc($menu['name']) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">
                            <?= esc($menu['description']) ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-orange-600">
                            Rp <?= number_format($menu['price'], 0, ',', '.') ?>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/dashboard/edit/<?= $menu['id'] ?>" class="text-blue-500 hover:text-blue-700 mr-3 font-semibold">Edit</a>
                            
                            <a href="/dashboard/delete/<?= $menu['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus menu ini?');" class="text-red-500 hover:text-red-700 font-semibold">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>