<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'id',
        'nama_obat',
        'jenis_obat',           // baru: minum/makan
        'jumlah_obat',          // ubah dari jumlah_pil
        'dikonsumsi',
        'dosis',
        'durasi',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
