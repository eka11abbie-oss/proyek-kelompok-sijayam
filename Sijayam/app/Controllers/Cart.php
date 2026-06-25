<?php
namespace App\Controllers;
use App\Models\MenuItemModel;

class Cart extends BaseController {
    public function add($id) {
        $model = new MenuItemModel();
        $product = $model->find($id);
        $cart = session()->get('cart') ?? [];

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'nama' => $product['nama'],
                'harga' => $product['harga'],
                'qty' => 1
            ];
        }

        session()->set('cart', $cart);
        return redirect()->to('/')->with('success', 'Menu ditambahkan ke keranjang!');
    }

    public function index() {
        return view('cart_view', ['cart' => session()->get('cart')]);
    }
}