<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenerimaResource\Pages;
use App\Models\Penerima;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenerimaResource extends Resource
{
    protected static ?string $model = Penerima::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    // Mengatasi pluralisasi otomatis
    protected static ?string $pluralModelLabel = 'Penerima';
    protected static ?string $navigationLabel = 'Penerima';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(16),
            Forms\Components\TextInput::make('alamat')
                ->label('Alamat')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('no_hp')
                ->label('Nomor Telepon')
                ->tel()
                ->nullable()
                ->maxLength(15),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor Telepon')
                    ->default('-'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y'),
            ])
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Baru Ditambahkan')
                    ->query(fn ($query) => $query->orderBy('created_at', 'desc')),
                Tables\Filters\Filter::make('without_phone')
                    ->label('Tanpa Nomor Telepon')
                    ->query(fn ($query) => $query->whereNull('no_hp')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenerima::route('/'),
            'create' => Pages\CreatePenerima::route('/create'),
            'edit' => Pages\EditPenerima::route('/{record}/edit'),
        ];
    }
}
