<?php

namespace App\Filament\Admin\Resources\PeminjamResource\Pages;

use App\Filament\Admin\Resources\PeminjamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeminjam extends EditRecord
{
    protected static string $resource = PeminjamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldStatus = $this->record->status;
        $newStatus = $data['status'];

        $barang = $this->record->barang;

        if ($oldStatus !== $newStatus) {
            // Jika dari MENUNGGU → DIPINJAM
            if ($oldStatus === 'menunggu' && $newStatus === 'dipinjam') {
                if ($barang->stok >= $this->record->jumlah) {
                    $barang->decrement('stok', $this->record->jumlah);
                } else {
                    $this->addError('jumlah', 'Stok barang tidak mencukupi.');
                }
            }

            // Jika dari DIPINJAM → DIKEMBALIKAN
            if ($oldStatus === 'dipinjam' && $newStatus === 'dikembalikan') {
                $barang->increment('stok', $this->record->jumlah);
            }
        }

        return $data;
    }
}
