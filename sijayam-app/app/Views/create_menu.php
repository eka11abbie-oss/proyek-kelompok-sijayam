<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Menu Baru</h2>
            <a href="/dashboard" class="text-gray-500 hover:text-orange-500 font-semibold">Batal & Kembali</a>
        </div>

        <form action="/dashboard/store" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Makanan</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                <input type="number" name="price" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea name="description" rows="3" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500"></textarea>
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg shadow-md transition">
                Simpan Menu
            </button>
        </form>
    </div>

</body>
</html>