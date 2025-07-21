<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PeminjamResource\Pages;
use App\Filament\Admin\Resources\PeminjamResource\RelationManagers;
use App\Models\Peminjam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamResource extends Resource
{
     protected static ?string $model = Peminjam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Peminjam';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nim_nip')->required(),
            Forms\Components\Select::make('barang_id')
                ->relationship('barang', 'nama')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('jumlah')
                ->numeric()
                ->required()
                ->rules([
                    function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                        $barangId = $get('barang_id');
                        $status = $get('status');

                        // Jika status = dipinjam, validasi max stok
                        if ($status === 'dipinjam' && $barangId) {
                            $barang = \App\Models\Barang::find($barangId);
                            return 'max:' . ($barang?->stok ?? 0);
                        }

                        // Jika status dikembalikan, tidak perlu validasi max stok
                        return null;
                    }
                ])
                ->label('Jumlah yang Dipinjam'),
            Forms\Components\DatePicker::make('tanggal_pinjam')->required(),
            Forms\Components\DatePicker::make('tanggal_kembali')->required(),
            Forms\Components\Textarea::make('keterangan'),
            Forms\Components\Select::make('status')
                ->options([
                    'menunggu' => 'Menunggu',
                    'dipinjam' => 'Dipinjam',
                    'dikembalikan' => 'Dikembalikan',
                ])
                ->default('menunggu')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama'),
            Tables\Columns\TextColumn::make('nim_nip'),
            Tables\Columns\TextColumn::make('barang.nama')->label('Barang'),
            Tables\Columns\TextColumn::make('jumlah'),
            Tables\Columns\TextColumn::make('tanggal_pinjam'),
            Tables\Columns\TextColumn::make('tanggal_kembali'),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'dipinjam',
                    'success' => 'dikembalikan',
                ]),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjam::route('/'),
            'create' => Pages\CreatePeminjam::route('/create'),
            'edit' => Pages\EditPeminjam::route('/{record}/edit'),
        ];
    }
}
