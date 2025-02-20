<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LingkunganResource\Pages;
use App\Filament\Resources\LingkunganResource\RelationManagers;
use App\Models\Lingkungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;

class LingkunganResource extends Resource
{
    protected static ?string $model = Lingkungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rt')
                    ->numeric()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rw')
                    ->numeric()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rw')
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
                Tables\Actions\ViewAction::make()->hidden(fn() => !Gate::allows("view_lingkungan")),
                Tables\Actions\EditAction::make()->hidden(fn() => !Gate::allows('update_lingkungan')),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Gate::allows('delete_lingkungan')),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Gate::allows('delete_lingkungan')),
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
            'index' => Pages\ListLingkungans::route('/'),
            'create' => Pages\CreateLingkungan::route('/create'),
            'view' => Pages\ViewLingkungan::route('/{record}'),
            'edit' => Pages\EditLingkungan::route('/{record}/edit'),
        ];
    }

    //✅ Menonaktifkan tombol " Navigasi " jika tidak memiliki akses view

    public static function canAccess(): bool
    {
        return Gate::allows('view_lingkungan');
    }

    //✅ Menonaktifkan tombol "Create New "
    public static function canCreate(): bool
    {
        return Gate::allows('create_lingkungan');
    }

    //

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('update_lingkungan');
    }
}
