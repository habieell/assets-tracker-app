<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
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
                    TextEntry::make('code')
                        ->label('Kode Aset'),

                    TextEntry::make('name')
                        ->label('Nama Aset'),

                    TextEntry::make('location')
                        ->label('Lokasi'),

                    TextEntry::make('status')
                        ->label('Status'),

                    TextEntry::make('input_date')
                        ->label('Tanggal Masuk')
                        ->date(),

                    TextEntry::make('barcode')
                        ->label('QR Code')
                        ->html()
                        ->getStateUsing(fn ($record) => (new DNS2D)->getBarcodeHTML($record->code, 'QRCODE', 5, 5)),
                ]),
        ];
    }
}