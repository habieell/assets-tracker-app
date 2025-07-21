<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Milon\Barcode\DNS2D;

class ViewAsset extends ViewRecord
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getInfolists(): array
    {
        return [
            Infolist::make()
                ->schema([
                    Section::make('Detail Aset')
                        ->schema([
                            TextEntry::make('code')->label('Kode Aset'),
                            TextEntry::make('name')->label('Nama Aset'),
                            TextEntry::make('location')->label('Lokasi'),
                            TextEntry::make('status')->label('Status'),
                            TextEntry::make('input_date')->label('Tanggal Masuk')->date(),
                        ])
                        ->columns(2),

                    Section::make('Foto Aset')
                        ->schema([
                            ImageEntry::make('asset_images')
                                ->label('Foto Aset')
                                ->getStateUsing(fn($record) => $record->asset_images ?? [])
                                ->visible(fn($record) => !empty($record->asset_images))
                                ->columnSpanFull()
                                ->multiple(),
                        ]),

                    Section::make('Foto Invoice')
                        ->schema([
                            ImageEntry::make('invoice_image')
                                ->label('Foto Invoice')
                                ->visible(fn($record) => !empty($record->invoice_image)),
                        ]),

                    Section::make('QR Code')
                        ->schema([
                            TextEntry::make('qr_code')
                                ->label('Kode QR')
                                ->html()
                                ->getStateUsing(fn($record) => (new DNS2D)->getBarcodeHTML($record->code, 'QRCODE', 5, 5)),
                        ]),
                ]),
        ];
    }
}