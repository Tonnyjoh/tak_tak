<?php

namespace App\Models;

use CodeIgniter\Model;

class ExchangeModel extends Model
{
    protected $table = 'exchanges';
    protected $primaryKey = 'id';
    protected $allowedFields = ["offered_item_id","requested_item_id","exchange_date","status"];

}