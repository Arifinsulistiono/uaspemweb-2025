<?php

namespace App\Filament\Admin\Resources\PeminjamResource\Pages;

use App\Filament\Admin\Resources\PeminjamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminjam extends ListRecords
{
    protected static string $resource = PeminjamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
