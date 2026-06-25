<?php

namespace App\Controllers;

class Checkout extends BaseController {

    public function process() {
        // 1. Ambil instance session agar lebih stabil
        $session = session();

        // 2. Cek apakah cart ada isinya, jika ya baru dihapus
        if ($session->has('cart')) {
            $session->remove('cart');
            
            // 3. Kirim pesan sukses
            return redirect()->to('/')->with('success', 'Pesanan Anda berhasil diproses! Silakan menunggu pesanan Anda.');
        }

        // 4. Jika user iseng klik checkout saat keranjang kosong, kembalikan ke menu
        return redirect()->to('/')->with('error', 'Keranjang Anda kosong.');
    }
}