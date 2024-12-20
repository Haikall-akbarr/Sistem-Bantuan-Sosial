<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistribusiResource\Pages;
use App\Filament\Resources\DistribusiResource\RelationManagers;
use App\Models\Distribusi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistribusiResource extends Resource
{
    protected static ?string $model = Distribusi::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penerima.nama')
                    ->label('Nama Penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('programBantuan.nama_program')
                    ->label('Program Bantuan'),
                Tables\Columns\DateColumn::make('tanggal_distribusi')
                    ->label('Tanggal Distribusi'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistribusis::route('/'),
            'create' => Pages\CreateDistribusi::route('/create'),
            'edit' => Pages\EditDistribusi::route('/{record}/edit'),
        ];
    }
}