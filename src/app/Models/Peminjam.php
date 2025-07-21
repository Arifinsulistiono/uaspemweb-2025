<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim_nip',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
    ];

    public function peminjam() {
    return $this->belongsTo(Peminjam::class);
}
 public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

}
