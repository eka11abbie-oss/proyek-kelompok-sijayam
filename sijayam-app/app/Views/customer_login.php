<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-orange-600">Selamat Datang!</h2>
            <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan pesanan Anda.</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-center text-sm font-bold">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-center text-sm font-bold">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form action="/customer/login/process" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" placeholder="Masukkan username">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg shadow transition">Masuk</button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun? <a href="/customer/register" class="text-orange-500 font-bold hover:underline">Daftar di sini</a>
        </p>
    </div>
</body>
</html>