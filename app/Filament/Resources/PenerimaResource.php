<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenerimaResource\Pages;
use App\Models\Penerima;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class PenerimaResource extends Resource
{
    protected static ?string $model = Penerima::class;

        //ganti nama model di navigasi/form/tabel
        protected static ?string $modelLabel = 'Penerima (Mustahik)';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategoriPenerima', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('lingkungan_id')
                    ->relationship('lingkungan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('tahun')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategoriPenerima.nama')
                    ->label('Kategori Penerima')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lingkungan.nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun')
                ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(fn() => !Gate::allows("view_penerima")),
                Tables\Actions\EditAction::make()->hidden(fn() => !Gate::allows("update_penerima")),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Gate::allows("delete_penerima")),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Gate::allows("delete_penerima")),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenerimas::route('/'),
            'create' => Pages\CreatePenerima::route('/create'),
            'view' => Pages\ViewPenerima::route('/{record}'),
            'edit' => Pages\EditPenerima::route('/{record}/edit'),
        ];
    }

    // Menonaktifkan tombol "Navigasi" jika tidak memiliki akses view
    public static function canAccess(): bool
    {
        return Gate::allows('view_penerima');
    }

    // Menonaktifkan tombol "Create New"
    public static function canCreate(): bool
    {
        return Gate::allows('create_penerima');
    }

    // Menonaktifkan edit untuk setiap record
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('update_penerima');
    }
}