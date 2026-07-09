<?php

namespace App\Models;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'description', 'price', 'image_url'];
    protected $useTimestamps    = true; // Karena kita pakai created_at dan updated_at
}