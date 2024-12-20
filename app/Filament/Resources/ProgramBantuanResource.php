<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramBantuanResource\Pages;
use App\Models\ProgramBantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramBantuanResource extends Resource
{
    protected static ?string $model = ProgramBantuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    // Mengatasi pluralisasi otomatis
    protected static ?string $pluralModelLabel = 'Program Bantuan';
    protected static ?string $navigationLabel = 'Program Bantuan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_program')
                ->label('Nama Program')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('deskripsi')
                ->label('Deskripsi')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_program')
                    ->label('Nama Program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y'),
            ])
            ->filters([])
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
            'index' => Pages\ListProgramBantuan::route('/'),
            'create' => Pages\CreateProgramBantuan::route('/create'),
            'edit' => Pages\EditProgramBantuan::route('/{record}/edit'),
        ];
    }
}
