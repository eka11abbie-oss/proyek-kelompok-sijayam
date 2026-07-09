<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Customer extends BaseController
{
    public function orders()
    {
        // Tolak jika belum login
        if (!session()->get('isCustomerLoggedIn')) return redirect()->to('/customer/login');

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $customerId = session()->get('customer_id');

        // Ambil riwayat pesanan milik pelanggan ini saja
        $orders = $orderModel->where('user_id', $customerId)->orderBy('created_at', 'DESC')->findAll();

        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel->select('order_items.*, menus.name')
                                             ->join('menus', 'menus.id = order_items.menu_id', 'left')
                                             ->where('order_id', $order['id'])
                                             ->findAll();
        }

        $data = ['orders' => $orders];
        return view('customer_orders', $data);
    }
}