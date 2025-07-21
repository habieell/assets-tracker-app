<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Carbon\Carbon;

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
                ->readOnly() // ✅ Tidak diketik manual, otomatis generate
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Nama Aset')
                ->required(),

            Forms\Components\Select::make('division_owner')
                ->label('Divisi (Data Owner)')
                ->options([
                    'IT' => 'IT - Perangkat Kerja',
                    'GA' => 'GA - Furniture',
                ])
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set, callable $get) => static::generateCode($set, $get)),

            Forms\Components\Select::make('category')
                ->label('Kategori')
                ->options([
                    'MOBIL' => 'Mobil',
                    'LAPTOP' => 'Laptop',
                    'PRINTER' => 'Printer',
                    'AC' => 'AC',
                    'FURNITURE' => 'Furniture',
                    'TV' => 'TV',
                    'CCTV' => 'CCTV',
                    'HANDPHONE' => 'Handphone'
                ])
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set, callable $get) => static::generateCode($set, $get)),

            Forms\Components\Hidden::make('asset_number'),

            Forms\Components\TextInput::make('location')->label('Lokasi'),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'aktif' => 'Aktif',
                    'rusak' => 'Rusak',
                    'dipindah' => 'Dipindah',
                    'inventaris' => 'Inventaris',
                ])
                ->required()
                ->default('aktif'),

            Forms\Components\DatePicker::make('input_date')
                ->label('Tanggal Masuk')
                ->default(today()),

            Forms\Components\DatePicker::make('end_of_life')
                ->label('Masa Akhir Manfaat'),


            Forms\Components\DatePicker::make('purchase_date')
                ->label('Tanggal Pembelian'),

            Forms\Components\DatePicker::make('used_date')
                ->label('Tanggal Digunakan'),

            Forms\Components\TextInput::make('penanggung_jawab')
                ->label('Penanggung Jawab')
                ->required(),

            Forms\Components\TextInput::make('purchase_price')
                ->label('Harga Pembelian')
                ->prefix('Rp')
                ->numeric()
                ->inputMode('decimal'),

            Forms\Components\TextInput::make('purchase_source')
                ->label('Sumber Pembelian'),

            Forms\Components\TextInput::make('invoice_number')
                ->label('Nomor Invoice'),

            // ✅ Multiple Foto Aset
            Forms\Components\FileUpload::make('asset_images')
                ->label('Foto Aset')
                ->directory('uploads/assets')
                ->multiple()
                ->reorderable()
                ->image()
                ->maxFiles(10)
                ->maxSize(2048)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('invoice_image')
                ->label('Foto Invoice')
                ->directory('uploads/invoices')
                ->image()
                ->maxSize(2048),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode')->wrap()->searchable(),
                Tables\Columns\TextColumn::make('division_owner')->label('Data Owner'),
                Tables\Columns\TextColumn::make('category')->label('Kategori'),
                Tables\Columns\TextColumn::make('name')->label('Nama Aset')->searchable(),
                Tables\Columns\TextColumn::make('location')->label('Lokasi'),
                Tables\Columns\TextColumn::make('purchase_source')->label('Sumber Pembelian'),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()
                    ->colors([
                        'success' => 'aktif',
                        'warning' => 'dipindah',
                        'danger' => 'rusak',
                        'info' => 'inventaris',
                    ]),
                Tables\Columns\TextColumn::make('end_of_life')->label('Masa Akhir Manfaat')->date(),
                Tables\Columns\TextColumn::make('penanggung_jawab')->label('Penanggung Jawab'),
                Tables\Columns\TextColumn::make('purchase_price')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format((float)$state, 0, ',', '.') : '-'),

                // ✅ Custom View untuk Multiple Image
                Tables\Columns\ViewColumn::make('asset_images')
                    ->label('Foto Aset')
                    ->view('tables.columns.asset-images'),

                Tables\Columns\ImageColumn::make('invoice_image')->label('Invoice')->square(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'MOBIL' => 'Mobil',
                        'LAPTOP' => 'Laptop',
                        'PRINTER' => 'Printer',
                        'AC' => 'AC',
                        'FURNITURE' => 'Furniture',
                        'TV' => 'TV',
                        'CCTV' => 'CCTV',
                        'HANDPHONE' => 'Handphone'
                    ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
            'print-barcode' => Pages\PrintBarcode::route('/print-barcode'),
        ];
    }

    protected static function generateCode(callable $set, callable $get): void
    {
        $division = $get('division_owner') ?? '';
        $category = $get('category') ?? '';
        $assetNumber = $get('asset_number');

        if (!$assetNumber) {
            $assetNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $set('asset_number', $assetNumber);
        }

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        if ($division && $category && $assetNumber) {
            $code = "ICG/{$division}/{$category}/{$assetNumber}/{$month}-{$year}";
            $set('code', $code);
        }
    }
}
