<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPenerimaResource\Pages;
use App\Models\KategoriPenerima;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class KategoriPenerimaResource extends Resource
{
    protected static ?string $model = KategoriPenerima::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255)
                    ->unique('kategori::penerimas', 'nama')
                    ->validationMessages([
                        'unique' => 'Nama sudah ada.',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(fn() => !Gate::allows('view_kategori::penerima')),
                Tables\Actions\EditAction::make()->hidden(fn() => !Gate::allows('update_kategori::penerima')),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Gate::allows('delete_kategori::penerima')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Gate::allows('delete_kategori::penerima')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriPenerimas::route('/'),
            'create' => Pages\CreateKategoriPenerima::route('/create'),
            'view' => Pages\ViewKategoriPenerima::route('/{record}'),
            'edit' => Pages\EditKategoriPenerima::route('/{record}/edit'),
        ];
    }

    // ✅ Menonaktifkan tombol "Navigasi" jika tidak memiliki akses view
    public static function canAccess(): bool
    {
        return Gate::allows('view_kategori::penerima');
    }

    // ✅ Menonaktifkan tombol "Create New"
    public static function canCreate(): bool
    {
        return Gate::allows('create_kategori::penerima');
    }

    // ✅ Menonaktifkan tombol Edit jika tidak memiliki akses
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('update_kategori::penerima');
    }
}
