<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    //ganti nama model di navigasi/form/tabel
    protected static ?string $modelLabel = 'User (Amil)';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->default(3), // Mengatur default value berdasarkan ID role
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->searchable(),

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
                Tables\Actions\ViewAction::make()->hidden(fn() => !Gate::allows("viewAny")),
                Tables\Actions\EditAction::make()->hidden(fn() => !Gate::allows('update_user')),
                Tables\Actions\DeleteAction::make()->hidden(fn() => !Gate::allows('delete_user')),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !Gate::allows('delete_user')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    //✅ Menonaktifkan tombol " Navigasi " jika tidak memiliki akses view

    public static function canAccess(): bool
    {
        return Gate::allows('view_user');
    }

    //✅ Menonaktifkan tombol "Create New "
    public static function canCreate(): bool
    {
        return Gate::allows('create_user');
    }
    
    //mencegah akses langsung lewat url
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('update_user');
    }
    

}
