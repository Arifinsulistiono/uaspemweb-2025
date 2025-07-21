<?php

namespace App\Filament\Admin\Resources\RiwayatResource\Pages;

use App\Filament\Admin\Resources\RiwayatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayat extends EditRecord
{
    protected static string $resource = RiwayatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
