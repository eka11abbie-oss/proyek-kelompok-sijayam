<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8 flex flex-col">
        
        <div class="flex justify-center mb-6">
            <img src="https://illustrations.popsy.co/red/remote-work.svg" alt="Login Illustration" class="h-48 object-contain">
        </div>

        <h1 class="text-3xl font-bold text-center text-gray-900 mb-8">Login</h1>

        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900">Let's Get Started</h2>
            <p class="text-sm text-gray-400">login to your account</p>
        </div>

        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-red-50 text-red-600 px-4 py-2 rounded-lg mb-4 text-sm font-medium text-center">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/process') ?>" method="POST" class="flex flex-col gap-4">
            <div>
                <label for="username" class="block text-xs font-bold text-gray-700 mb-2">Username</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" 
                    placeholder="Masukkan username">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" 
                        placeholder="••••••••">
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl mt-4 transition-colors shadow-lg shadow-red-600/30">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center text-sm font-medium text-gray-500">
            Don't have an account? 
            <a href="<?= base_url('customer/register') ?>" class="text-red-600 hover:underline">Create here</a>
        </div>
    </div>

</body>
</html>