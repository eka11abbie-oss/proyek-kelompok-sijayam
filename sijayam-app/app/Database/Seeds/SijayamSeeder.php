<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class SijayamSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->insertBatch([['name' => 'Admin'], ['name' => 'Customer']]);

        $this->db->table('users')->insert([
            'role_id' => 1,
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT), // Akun Admin: username 'admin', password 'admin123'
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->table('menus')->insertBatch([
            ['name' => 'Ayam Bakar Sijayam', 'description' => 'Ayam bakar spesial.', 'price' => 25000, 'image_url' => 'ayam1.jpg', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Nasi Goreng Spesial', 'description' => 'Nasi goreng pedas.', 'price' => 20000, 'image_url' => 'nasi1.jpg', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }
}