<?php
namespace App\Models;
use CodeIgniter\Model;
class ItemModel extends Model {
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ["title","user_id","category_id","description","estimated_price","added_time"];

}
