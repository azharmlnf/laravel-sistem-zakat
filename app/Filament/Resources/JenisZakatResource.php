<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisZakatResource\Pages;
use App\Filament\Resources\JenisZakatResource\RelationManagers;
use App\Models\JenisZakat;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;


class JenisZakatResource extends Resource
{
    protected static ?string $model = JenisZakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Select::make('satuan')
                    ->options(JenisZakat::getEnumValues('satuan')) // ✅ Panggil dari Model
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan'),
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
                Tables\Actions\ViewAction::make()->hidden(fn()=> !Gate::allows('view_jenis::zakat')),
                Tables\Actions\EditAction::make()->hidden(fn()=> !Gate::allows('update_jenis::zakat')),
                Tables\Actions\DeleteAction::make()->hidden(fn()=> !Gate::allows('delete_jenis::zakat'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn()=> !Gate::allows('delete_jenis::zakat')),
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
            'index' => Pages\ListJenisZakats::route('/'),
            'create' => Pages\CreateJenisZakat::route('/create'),
            'view' => Pages\ViewJenisZakat::route('/{record}'),
            'edit' => Pages\EditJenisZakat::route('/{record}/edit'),
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
           return Gate::allows('create_jenis::zakat');
        }

    
        //menonaktifkan edit 
    
        public static function canEdit(Model $record): bool
        {
            return Gate::allows('update_lingkungan'); 
        } 
}
