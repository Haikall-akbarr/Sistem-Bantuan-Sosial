<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistribusiResource\Pages;
use App\Models\Distribusi;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DistribusiResource extends Resource
{
    protected static ?string $model = Distribusi::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    // Mengatasi pluralisasi otomatis
    protected static ?string $pluralModelLabel = 'Distribusi';
    protected static ?string $navigationLabel = 'Distribusi';

    // Form untuk tambah atau edit data
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('penerima_id')
                ->label('Penerima')
                ->relationship('penerima', 'nama')
                ->required(),
            Forms\Components\Select::make('program_bantuan_id')
                ->label('Program Bantuan')
                ->relationship('programBantuan', 'nama_program')
                ->required(),
            Forms\Components\DatePicker::make('tanggal_distribusi')
                ->label('Tanggal Distribusi')
                ->required(),
            Forms\Components\TextInput::make('status')
                ->label('Status')
                ->default('Diterima')
                ->required(),
        ]);
    }

    // Tabel untuk menampilkan data
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penerima.nama')
                    ->label('Nama Penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('programBantuan.nama_program')
                    ->label('Program Bantuan'),
                Tables\Columns\TextColumn::make('tanggal_distribusi')
                    ->label('Tanggal Distribusi')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                Tables\Filters\Filter::make('status')
                    ->label('Status Distribusi')
                    ->query(fn ($query, $data) => $query->where('status', $data))
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Diterima' => 'Diterima',
                                'Ditunda' => 'Ditunda',
                                'Ditolak' => 'Ditolak',
                            ]),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Konfigurasi halaman
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistribusi::route('/'),
            'create' => Pages\CreateDistribusi::route('/create'),
            'edit' => Pages\EditDistribusi::route('/{record}/edit'),
        ];
    }
}
