<?php

namespace App\Models;

use CodeIgniter\Model;

class ShowSeatPricing extends Model
{
    protected $table = 'r_show_schedule';
    protected $primaryKey = 'id_schedule_show';
    protected $allowedFields = ['id_schedule', 'id_pricing']; // Data yang bisa diinsert  
}
