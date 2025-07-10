<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('printAll')
                ->label('Cetak Semua Barcode')
                ->icon('heroicon-o-printer')
                ->url(route('filament.admin.resources.assets.print-barcode'))
        ];
    }
}