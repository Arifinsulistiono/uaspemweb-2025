<?php

namespace App\Filament\Admin\Resources\PeminjamResource\Pages;

use App\Filament\Admin\Resources\PeminjamResource;
use App\Models\Barang;
use Filament\Resources\Pages\CreateRecord;

class CreatePeminjam extends CreateRecord
{
    protected static string $resource = PeminjamResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        $barang = $record->barang;

        // Kurangi stok jika status = dipinjam
            if ($record->status === 'dipinjam') {
            if ($barang->stok >= $record->jumlah) {
                $barang->decrement('stok', $record->jumlah);
            } else {
                // Optional: bisa batalkan proses kalau stok tidak cukup
                // atau buat validasi di form agar ini tidak pernah terjadi
            }
        }
    }
}
