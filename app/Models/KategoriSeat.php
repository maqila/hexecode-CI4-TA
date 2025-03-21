<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriSeat extends Model
{
    protected $table = 'm_seat_category';
    protected $primaryKey = 'id_kategori_seat';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nama_kategori',
        'denah_seat'
    ];

    protected $useTimestamps = false;
}
