<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramBantuanResource\Pages;
use App\Filament\Resources\ProgramBantuanResource\RelationManagers;
use App\Models\ProgramBantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramBantuanResource extends Resource
{
    protected static ?string $model = ProgramBantuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_program')
                ->label('Nama Program')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->nullable()
                ->maxLength(500),
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
                    ->label('Deskripsi')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y'),
            ])
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Program Terbaru')
                    ->query(fn ($query) => $query->orderBy('created_at', 'desc')),
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
            'index' => Pages\ListProgramBantuans::route('/'),
            'create' => Pages\CreateProgramBantuan::route('/create'),
            'edit' => Pages\EditProgramBantuan::route('/{record}/edit'),
        ];
    }
}
