<?php
namespace App\Controllers;
use App\Models\MenuItemModel;

class Admin extends BaseController {
    public function index() {
        return view('admin_panel');
    }

    public function save() {
        $model = new MenuItemModel();
        $model->save([
            'nama'      => $this->request->getPost('nama'),
            'harga'     => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);
        return redirect()->to('/')->with('message', 'Menu berhasil ditambah!');
    }
}