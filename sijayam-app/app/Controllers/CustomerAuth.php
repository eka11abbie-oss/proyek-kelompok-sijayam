<?php

namespace App\Controllers;
use App\Models\UserModel;

class CustomerAuth extends BaseController
{
    // 1. Menampilkan halaman form pendaftaran
    public function register()
    {
        return view('customer_register');
    }

    // 2. Memproses data dari form dan menyimpannya ke database
    public function processRegister()
    {
        $userModel = new UserModel();
        
        $data = [
            'role_id'  => 2, // 2 adalah Role khusus untuk Customer
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);
        
        // Setelah berhasil daftar, lempar pengguna kembali ke Gerbang Utama (/)
        // dengan membawa pesan sukses
        return redirect()->to('/')->with('msg', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
    }
}