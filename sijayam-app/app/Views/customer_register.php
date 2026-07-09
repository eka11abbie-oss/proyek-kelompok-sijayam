<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex">

    <div class="w-full md:w-1/2 flex flex-col p-8 md:p-12 relative h-screen">
        
        <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
            <h2 class="text-3xl font-bold text-gray-900 mb-2 text-left">Buat Akun Baru</h2>
            <p class="text-gray-500 text-sm mb-8">Daftar sekarang untuk mulai memesan makanan favorit Anda.</p>

            <form action="<?= base_url('customer/register/process') ?>" method="POST">
                
                <div class="mb-5">
                    <label for="username" class="block text-xs font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition-all text-sm duration-200" 
                        placeholder="Pilih username unik Anda">
                </div>

                <div class="mb-8">
                    <label for="password" class="block text-xs font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition-all text-sm duration-200" 
                        placeholder="Minimal 8 karakter">
                </div>

                <button type="submit" class="w-full bg-[#111827] hover:bg-black text-white font-semibold py-3 px-4 rounded-lg transition-colors shadow-md">
                    Sign up
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Already have an account? 
                <a href="<?= base_url('/') ?>" class="text-blue-600 font-medium hover:underline">Sign in</a>
            </div>
        </div>

        <div class="text-center text-xs text-gray-400 pb-2">
            © 2023 ALL RIGHTS Sijayam
        </div>
    </div>

    <div class="hidden md:block w-1/2 p-4 h-screen">
        <div class="w-full h-full rounded-[2rem] overflow-hidden relative shadow-xl bg-cover bg-center"
             style="background-image: url('/asset/Logasset .png');">
        </div>
    </div>

</body>
</html>