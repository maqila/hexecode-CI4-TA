<?php

namespace App\Models;

use CodeIgniter\Model;

class AudisiPricing extends Model
{
    protected $table = 'r_audisi_schedule';
    protected $primaryKey = 'id_audisi_schedule';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_schedule',
        'id_pricing_audisi'
    ];

    protected $useTimestamps = false;
}
