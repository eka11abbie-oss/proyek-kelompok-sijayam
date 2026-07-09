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
<body class="bg-white min-h-screen flex">

    <!-- BAGIAN KIRI: Form Login -->
    <div class="w-full md:w-1/2 flex flex-col p-8 md:p-12 relative h-screen">
        
        <!-- Wrapper Form agar di tengah secara vertikal -->
        <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-left">Selamat Datang !</h2>

            <!-- Pesan Error -->
            <?php if(session()->getFlashdata('msg')): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg relative mb-6 text-sm font-medium">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/process') ?>" method="POST">
                <!-- Input Username (Desain Figma pakai Email, tapi sistem kita pakai Username) -->
                <div class="mb-5">
                    <label for="username" class="block text-xs font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition-colors text-sm" 
                        placeholder="Contoh: Budi123">
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-xs font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition-colors text-sm" 
                        placeholder="At least 8 characters">
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-end mb-8">
                    <a href="#" class="text-xs text-blue-600 hover:text-blue-800 font-medium transition-colors">Forgot Password?</a>
                </div>

                <!-- Tombol Sign In (Sesuai warna gelap di Figma) -->
                <button type="submit" class="w-full bg-[#111827] hover:bg-black text-white font-semibold py-3 px-4 rounded-lg transition-colors shadow-md">
                    Sign in
                </button>
            </form>

            <!-- Link Sign Up -->
            <div class="mt-8 text-center text-sm text-gray-500">
                Don't you have an account? 
                <a href="<?= base_url('customer/register') ?>" class="text-orange-500 font-bold hover:text-orange-600 hover:underline inline-block mt-2 transition-colors">
            </div>
        </div>

        <!-- Footer Hak Cipta -->
        <div class="text-center text-xs text-gray-400 pb-2">
            © 2023 ALL RIGHTS Sijayam
        </div>
    </div>

    <div class="hidden md:block w-1/2 p-4 h-screen">
        
        <div class="w-full h-full rounded-[2rem] overflow-hidden relative shadow-xl bg-cover bg-center"
             style="background-image: url('/asset/Logassetfiks.png');">
            
            </div>
    </div>

</body>
</html>

</body>
</html>