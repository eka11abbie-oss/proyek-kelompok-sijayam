<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        $session = session();
        // Cegah user yang sudah login balik ke form login
        if ($session->get('isLoggedIn')) return redirect()->to('/dashboard');
        if ($session->get('isCustomerLoggedIn')) return redirect()->to('/menu');
        
        return view('login_page');
    }

    public function process()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $userModel->where('username', $username)->first();

        if ($data && password_verify($password, $data['password'])) {
            
            // CEK ROLE: 1 = Admin, 2 = Customer
            if ($data['role_id'] == 1) {
                $session->set([
                    'id'         => $data['id'],
                    'username'   => $data['username'],
                    'isLoggedIn' => TRUE
                ]);
                return redirect()->to('/dashboard');
                
            } else if ($data['role_id'] == 2) {
                $session->set([
                    'customer_id'        => $data['id'],
                    'customer_username'  => $data['username'],
                    'isCustomerLoggedIn' => TRUE
                ]);
                return redirect()->to('/menu');
            }

        } else {
            return redirect()->to('/')->with('msg', 'Username atau Password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}