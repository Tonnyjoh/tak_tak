<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPhotoModel extends Model
{
    protected $table = 'item_photos';
    protected $primaryKey = 'id';
    protected $allowedFields = ["item_id","photo_url"];

}