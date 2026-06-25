<?php

namespace App\Controllers;

use App\Models\MenuItemModel; // Pastikan use statement ini ada

class Menu extends BaseController
{
    public function index()
    {
        $model = new MenuItemModel(); // Inisialisasi model
        $data['menu'] = $model->findAll();
        
        return view('menu_list', $data);
    }
}