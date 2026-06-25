<?php
namespace App\Controllers;
use App\Models\MenuItemModel;

class Home extends BaseController {
    public function index() {
        $model = new MenuItemModel();
        $data['menu'] = $model->getMenuWithCategory(); // Mengambil data lengkap
        return view('landing_page', $data);
    }
}