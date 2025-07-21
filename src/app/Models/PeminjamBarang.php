<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamBarang extends Model
{
    protected $fillable = [
        'peminjam_id', 'barang_id', 'jumlah', 'tanggal_pinjam', 'tanggal_kembali', 'status'
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
