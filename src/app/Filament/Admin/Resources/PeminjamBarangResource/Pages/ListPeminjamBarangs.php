<?php

namespace App\Filament\Admin\Resources\PeminjamBarangResource\Pages;

use App\Filament\Admin\Resources\PeminjamBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamBarangs extends ListRecords
{
    protected static string $resource = PeminjamBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
