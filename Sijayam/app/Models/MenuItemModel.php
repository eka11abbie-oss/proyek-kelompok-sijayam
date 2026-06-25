<?php
namespace App\Models;
use CodeIgniter\Model;

class MenuItemModel extends Model {
    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'nama', 'deskripsi', 'harga', 'image_url', 'is_available', 'is_best_seller'];

    // Fungsi untuk mengambil menu beserta nama kategorinya
    public function getMenuWithCategory() {
        return $this->select('menu_items.*, categories.nama as nama_kategori')
                    ->join('categories', 'categories.id = menu_items.category_id')
                    ->findAll();
    }
}