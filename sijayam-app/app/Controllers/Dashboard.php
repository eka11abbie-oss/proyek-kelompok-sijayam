<?php

namespace App\Controllers;
use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        
        // Proteksi Halaman: Cek apakah user sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('msg', 'Silakan login terlebih dahulu.');
        }

        $menuModel = new MenuModel();
        $data = [
            'title' => 'Dashboard Admin - Sijayam',
            'menus' => $menuModel->findAll() // Ambil semua data makanan
        ];

        return view('dashboard', $data);
    }
    public function create()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');
        
        $data = ['title' => 'Tambah Menu - Sijayam Admin'];
        return view('create_menu', $data);
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $menuModel = new MenuModel();
        
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            // Untuk MVP, image_url kita isi manual dulu atau pakai teks default
            'image_url'   => 'default-food.jpg' 
        ];

        $menuModel->insert($data);
        return redirect()->to('/dashboard');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $menuModel = new MenuModel();
        $menuModel->delete($id);
        
        return redirect()->to('/dashboard');
    }
    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $menuModel = new MenuModel();
        $data = [
            'title' => 'Edit Menu - Sijayam Admin',
            'menu'  => $menuModel->find($id) // Cari menu berdasarkan ID
        ];

        return view('edit_menu', $data);
    }

    public function update($id)
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $menuModel = new MenuModel();
        
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
        ];

        $menuModel->update($id, $data); // Update data ke database
        return redirect()->to('/dashboard');
    }
    public function orders()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // [BARU] Melakukan JOIN ke tabel users untuk mengambil username
        $orders = $orderModel->select('orders.*, users.username')
                             ->join('users', 'users.id = orders.user_id', 'left')
                             ->orderBy('orders.created_at', 'DESC')
                             ->findAll();

        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel->select('order_items.*, menus.name')
                                             ->join('menus', 'menus.id = order_items.menu_id', 'left')
                                             ->where('order_id', $order['id'])
                                             ->findAll();
        }

        $data = [
            'title'  => 'Pesanan Masuk - Sijayam Admin',
            'orders' => $orders
        ];

        return view('orders', $data);
    }

    public function updateOrderStatus($id)
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $orderModel = new OrderModel();
        $status = $this->request->getPost('status');
        
        // Memperbarui status pesanan
        $orderModel->update($id, ['status' => $status]);
        
        return redirect()->to('/dashboard/orders');
    }
}