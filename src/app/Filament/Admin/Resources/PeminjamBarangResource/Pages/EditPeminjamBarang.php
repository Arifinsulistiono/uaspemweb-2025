<?php

namespace App\Filament\Admin\Resources\PeminjamBarangResource\Pages;

use App\Filament\Admin\Resources\PeminjamBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeminjamBarang extends EditRecord
{
    protected static string $resource = PeminjamBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
