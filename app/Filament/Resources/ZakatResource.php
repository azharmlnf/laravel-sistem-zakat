<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZakatResource\Pages;
use App\Filament\Resources\ZakatResource\RelationManagers;
use App\Models\Zakat;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class ZakatResource extends Resource
{
    protected static ?string $model = Zakat::class;
    //ganti nama model di navigasi/form/tabel
    protected static ?string $modelLabel = 'Zakat (Muzaki)';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pemberi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('lingkungan_id')
                    ->relationship('lingkungan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('jenis_id')
                    ->relationship('jenis_zakat', 'nama')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TextInput::make('tahun')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemberi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lingkungan.nama')
                    ->numeric()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_zakat.nama')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun'),
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
                SelectFilter::make('jenis_zakat')
                    ->relationship('jenis_zakat', 'nama')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('lingkungan')
                    ->relationship('lingkungan', 'nama')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->hidden(fn() => !Gate::allows('view_zakat')),
                Tables\Actions\EditAction::make()
                    ->hidden(fn() => !Gate::allows('update_zakat')),
                Tables\Actions\DeleteAction::make()
                    ->hidden(fn() => !Gate::allows('delete_zakat')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->hidden(fn() => !Gate::allows('delete_zakat')),

                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->fromTable() // Ekspor berdasarkan tabel
                                ->withFilename(fn($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                                ->withWriterType(\Maatwebsite\Excel\Excel::CSV) // Bisa diganti dengan XLSX
                                ->withColumns([
                                    Column::make('nama_pemberi'),
                                    Column::make('lingkungan.nama'),
                                    Column::make('jenis_zakat.nama'),
                                    Column::make('jumlah'),
                                    Column::make('tanggal'),
                                    Column::make('tahun'),
                                    Column::make('created_at'),
                                ]),
                        ]),
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
            'index' => Pages\ListZakats::route('/'),
            'create' => Pages\CreateZakat::route('/create'),
            'view' => Pages\ViewZakat::route('/{record}'),
            'edit' => Pages\EditZakat::route('/{record}/edit'),
        ];
    }

    // ✅ Cek apakah user memiliki akses ke resource ini
    public static function canAccess(): bool
    {
        return Gate::allows('view_zakat');
    }

    // ✅ Menonaktifkan tombol "Create New" jika tidak punya akses
    public static function canCreate(): bool
    {
        return Gate::allows('create_zakat');
    }

    // ✅ Mencegah akses langsung ke Edit lewat URL
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('update_zakat');
    }

    // ✅ Mencegah akses langsung ke View lewat URL
    public static function canView(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('view_zakat');
    }

    // ✅ Mencegah akses langsung ke Delete lewat URL
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Gate::allows('delete_zakat');
    }
}
