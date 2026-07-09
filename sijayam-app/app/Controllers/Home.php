<?php

namespace App\Controllers;
use App\Models\MenuModel;

class Home extends BaseController
{
    public function index()
    {
        // Tolak jika belum login sebagai customer
        if (!session()->get('isCustomerLoggedIn')) {
            return redirect()->to('/')->with('msg', 'Silakan login terlebih dahulu untuk melihat menu.');
        }

        $menuModel = new MenuModel();
        $data['menus'] = $menuModel->findAll(); 
        
        return view('landing_page', $data); 
    }
}