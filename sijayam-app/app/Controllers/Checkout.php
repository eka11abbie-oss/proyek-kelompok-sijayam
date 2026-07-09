<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Checkout extends BaseController
{
    public function index()
    {
        return view('checkout_page');
    }

    public function process()
    {
        // Proteksi: Hanya user yang login yang bisa checkout
        if (!session()->get('isCustomerLoggedIn')) {
            return redirect()->to('/customer/login')->with('error', 'Sesi telah habis, silakan login kembali.');
        }

        $cartData = json_decode($this->request->getPost('cart_data'), true);
        $totalPrice = $this->request->getPost('total_price');

        if (empty($cartData)) {
            return redirect()->to('/')->with('msg', 'Keranjang Anda kosong!');
        }

        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel();

        // Mengambil ID Pelanggan dari Session
        $customerId = session()->get('customer_id');

        $orderId = $orderModel->insert([
            'user_id'     => $customerId, 
            'total_price' => $totalPrice,
            'status'      => 'Pending'
        ]);

        foreach ($cartData as $item) {
            $orderItemModel->insert([
                'order_id' => $orderId,
                'menu_id'  => $item['id'],
                'quantity' => $item['qty'],
                'price'    => $item['price']
            ]);
        }

        // Redirect ke halaman pelacakan pesanan
        return redirect()->to('/customer/orders')->with('success', 'Pesanan berhasil dibuat!');
    }
}