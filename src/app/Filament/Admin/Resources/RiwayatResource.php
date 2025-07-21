<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RiwayatResource\Pages;
use App\Models\Peminjam;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RiwayatResource extends Resource
{
    protected static ?string $model = Peminjam::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Riwayat';
    protected static ?string $navigationGroup = 'Laporan';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // Tidak perlu form
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('nim_nip')->label('NIM/NIP'),
                Tables\Columns\TextColumn::make('barang.nama')->label('Barang'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah'),
                Tables\Columns\TextColumn::make('tanggal_pinjam')->date()->label('Tgl Pinjam'),
                Tables\Columns\TextColumn::make('tanggal_kembali')->date()->label('Tgl Kembali'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'dipinjam',
                        'success' => 'dikembalikan',
                    ])
                    ->label('Status'),
            ])
            ->actions([]) // ❌ tanpa Edit
            ->bulkActions([]); // ❌ tanpa Delete
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayats::route('/'),
        ];
    }
}
