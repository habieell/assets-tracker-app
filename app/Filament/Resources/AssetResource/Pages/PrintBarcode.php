<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use App\Models\Asset;
use Filament\Resources\Pages\Page;
use Illuminate\Http\Request;

class PrintBarcode extends Page
{
    protected static string $resource = AssetResource::class;

    protected static string $view = 'filament.resources.asset-resource.pages.print-barcode';

    public $assets;

    public function mount(Request $request, ?int $record = null): void
    {
        if ($record) {
            $asset = Asset::findOrFail($record);
            $this->assets = collect([$asset]); // Bungkus dalam collection
        } else {
            $this->assets = Asset::all(); // Cetak semua
        }
    }
}