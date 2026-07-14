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
            [
                'name' => 'Ayam Bakar Sijayam', 
                'description' => 'Ayam bakar spesial bumbu kecap meresap dengan sambal terasi.', 
                'price' => 25000, 
                'image_url' => 'https://images.unsplash.com/photo-1598514982205-f36b96d1e8d4?q=80&w=800&auto=format&fit=crop', 
                'category' => 'ayam',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ayam Goreng Penyet', 
                'description' => 'Ayam goreng renyah dipenyet dengan sambal bawang super pedas.', 
                'price' => 22000, 
                'image_url' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=800&auto=format&fit=crop', 
                'category' => 'ayam',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nasi Goreng Spesial', 
                'description' => 'Nasi goreng pedas dengan telur mata sapi dan kerupuk.', 
                'price' => 20000, 
                'image_url' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=800&auto=format&fit=crop', 
                'category' => 'nasi',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Es Teh Manis', 
                'description' => 'Teh manis dingin menyegarkan, cocok untuk pereda pedas.', 
                'price' => 5000, 
                'image_url' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=800&auto=format&fit=crop', 
                'category' => 'minuman',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Es Jeruk Peras', 
                'description' => 'Perasan jeruk asli yang manis dan kaya vitamin C.', 
                'price' => 8000, 
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?q=80&w=800&auto=format&fit=crop', 
                'category' => 'minuman',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}