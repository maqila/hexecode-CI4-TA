<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiAudisi extends Model
{
    protected $table = 'm_lokasi_audisi';
    protected $primaryKey = 'id_location_audisi';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'tempat',
        'kota'
    ];

    protected $useTimestamps = false;
}
