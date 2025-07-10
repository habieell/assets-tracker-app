<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Milon\Barcode\DNS1D;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Aset';
    protected static ?string $label = 'Aset';
    protected static ?string $pluralLabel = 'Data Aset';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('code')
                ->label('Kode Aset')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('name')
                ->label('Nama Aset')
                ->required(),

            Forms\Components\TextInput::make('location')
                ->label('Lokasi')
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'aktif' => 'Aktif',
                    'rusak' => 'Rusak',
                    'dipindah' => 'Dipindah',
                ])
                ->required()
                ->default('aktif'),

            Forms\Components\DatePicker::make('input_date')
                ->label('Tanggal Masuk'),

            Forms\Components\Select::make('user_id')
                ->label('Penanggung Jawab')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('purchase_date')
                ->label('Tanggal Pembelian'),

            Forms\Components\DatePicker::make('used_date')
                ->label('Tanggal Digunakan'),

            Forms\Components\TextInput::make('purchase_price')
                ->label('Harga Pembelian')
                ->prefix('Rp')
                ->numeric()
                ->inputMode('decimal'),

            Forms\Components\TextInput::make('purchase_source')
                ->label('Sumber Pembelian'),

            Forms\Components\TextInput::make('invoice_number')
                ->label('Nomor Invoice'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Aset')
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'aktif',
                        'warning' => 'dipindah',
                        'danger' => 'rusak',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('input_date')
                    ->label('Tanggal Masuk')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penanggung Jawab'),

                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Tanggal Pembelian')
                    ->date(),

                Tables\Columns\TextColumn::make('used_date')
                    ->label('Tanggal Digunakan')
                    ->date(),

                Tables\Columns\TextColumn::make('purchase_price')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format((float)$state, 2, ',', '.')),

                Tables\Columns\TextColumn::make('purchase_source')
                    ->label('Sumber Pembelian'),

                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Nomor Invoice'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('print')
                    ->label('Cetak Barcode')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('filament.admin.resources.assets.print-barcode', ['record' => $record->id]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
            'print-barcode' => Pages\PrintBarcode::route('/print-barcode/{record?}'),
        ];
    }
}