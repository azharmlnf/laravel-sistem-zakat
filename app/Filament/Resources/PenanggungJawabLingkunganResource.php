<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenanggungJawabLingkunganResource\Pages;
use App\Filament\Resources\PenanggungJawabLingkunganResource\RelationManagers;
use App\Models\PenanggungJawabLingkungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;

class PenanggungJawabLingkunganResource extends Resource
{
    protected static ?string $model = PenanggungJawabLingkungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('lingkungan_id')
                    ->relationship('lingkungan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lingkungan.nama')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make()->hidden(fn() => !Gate::allows('view_penanggung::jawab::lingkungan')),
                Tables\Actions\EditAction::make()->hidden(fn() => !Gate::allows("update_penanggung::jawab::lingkungan")),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Gate::allows('delete_penanggung::jawab::lingkungan'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPenanggungJawabLingkungans::route('/'),
            'create' => Pages\CreatePenanggungJawabLingkungan::route('/create'),
            'view' => Pages\ViewPenanggungJawabLingkungan::route('/{record}'),
            'edit' => Pages\EditPenanggungJawabLingkungan::route('/{record}/edit'),
        ];
    }
    //✅ Menonaktifkan tombol " Navigasi " jika tidak memiliki akses view

    public static function canAccess(): bool
    {
        return Gate::allows('view_penanggung::jawab::lingkungan');
    }

    //✅ Menonaktifkan tombol "Create New "
    public static function canCreate(): bool
    {
        return Gate::allows('create_penanggung::jawab:lingkungan');
    }

    //menonaktifkan edit 
    public static function canEdit(Model $record): bool
    {
        return Gate::allows('update_penanggung::jawab::lingkungan');
    }
}
