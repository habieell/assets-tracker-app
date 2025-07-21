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
        $query = Asset::query();

        if (request()->has('record')) {
            // ✅ Print single asset
            $this->assets = $query->where('id', request('record'))->get();
            return;
        }

        if (request()->has('selected')) {
            // ✅ Print selected assets
            $ids = explode(',', request('selected'));
            $this->assets = $query->whereIn('id', $ids)->get();
            return;
        }

        if (request()->has('tableFilters')) {
            // ✅ Print with filters from query
            $filters = request()->query('tableFilters');

            if (!empty($filters['category']['value'])) {
                $query->where('category', $filters['category']['value']);
            }

            // ✅ Bisa tambahkan filter lain jika ada
        }

        $this->assets = $query->get();
    }
}