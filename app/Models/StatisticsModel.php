<?php
namespace App\Models;

use CodeIgniter\Model;

class StatisticsModel extends Model
{
    protected $table = 'usage_statistics';
    protected $primaryKey = 'id';
    protected $allowedFields = ["user_count","exchange_count","last_update"];

}
