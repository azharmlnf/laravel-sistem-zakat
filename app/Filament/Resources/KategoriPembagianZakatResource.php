<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPembagianZakatResource\Pages;
use App\Filament\Resources\KategoriPembagianZakatResource\RelationManagers;
use App\Models\KategoriPembagianZakat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;

class KategoriPembagianZakatResource extends Resource
{
    protected static ?string $model = KategoriPembagianZakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategoriPenerima', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                    // ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('jumlah_beras')
                    ->required()
                    ->prefix('Kg')
                    ->numeric(),
                Forms\Components\TextInput::make('jumlah_uang')
                    ->required()
                    ->prefix('Rp')
                    ->numeric(),
                Forms\Components\TextInput::make('tahun')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategoriPenerima.nama')
                    ->label('Kategori Penerima')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_beras')
                    ->numeric()
                    ->suffix('Kg')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_uang')
                    ->numeric()
                    ->prefix('Rp. ')
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
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriPembagianZakats::route('/'),
            'create' => Pages\CreateKategoriPembagianZakat::route('/create'),
            'view' => Pages\ViewKategoriPembagianZakat::route('/{record}'),
            'edit' => Pages\EditKategoriPembagianZakat::route('/{record}/edit'),
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
