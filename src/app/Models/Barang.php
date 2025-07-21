<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'stok',
        'satuan',
    ];

    // Relasi: 1 barang bisa dipinjam berkali-kali
    public function peminjams()
    {
        return $this->hasMany(Peminjam::class);
    }
}
