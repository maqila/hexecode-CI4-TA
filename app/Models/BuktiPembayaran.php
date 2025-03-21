<?php

namespace App\Models;

use CodeIgniter\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'm_bukti_pembayaran';
    protected $primaryKey = 'id_bukti_pembayaran';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_audiens',
        'id_teater',
        'tgl_upload',
        'is_valid',
        'tgl_validated'
    ];
}