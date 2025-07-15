<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\Page;
use App\Models\Asset;

class PrintBarcode extends Page
{
    protected static string $resource = AssetResource::class;
    protected static string $view = 'filament.resources.asset-resource.pages.print-barcode';

    public $assets;

    public function mount(): void
    {
        if (request()->has('record')) {
            $this->assets = Asset::where('id', request('record'))->get();
        } elseif (request()->has('selected')) {
            $ids = explode(',', request('selected'));
            $this->assets = Asset::whereIn('id', $ids)->get();
        } elseif (request()->has('tableFilters')) {
            $filters = request()->query('tableFilters');
            $query = Asset::query();

            if (!empty($filters['category']['value'])) {
                $query->where('category', $filters['category']['value']);
            }

            $this->assets = $query->get();
        } else {
            $this->assets = Asset::all();
        }
    }
}
