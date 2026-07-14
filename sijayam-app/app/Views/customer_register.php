<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sijayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8 flex flex-col">
        
        <div class="flex justify-center mb-4">
            <img src="https://illustrations.popsy.co/red/surreal-hourglass.svg" alt="Register Illustration" class="h-40 object-contain">
        </div>

        <h1 class="text-3xl font-bold text-center text-gray-900 mb-6">Register</h1>

        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900">Create Account</h2>
            <p class="text-sm text-gray-400">join us and start ordering</p>
        </div>

        <form action="<?= base_url('customer/register/process') ?>" method="POST" class="flex flex-col gap-4">
            
            <div>
                <label for="username" class="block text-xs font-bold text-gray-700 mb-2">Username Baru</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" 
                    placeholder="Pilih username unik">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 text-sm transition-all" 
                    placeholder="Minimal 8 karakter">
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl mt-4 transition-colors shadow-lg shadow-red-600/30">
                Sign Up
            </button>
        </form>

        <div class="mt-8 text-center text-sm font-medium text-gray-500">
            Already have an account? 
            <a href="<?= base_url('/') ?>" class="text-red-600 hover:underline">Login here</a>
        </div>
    </div>

</body>
</html>