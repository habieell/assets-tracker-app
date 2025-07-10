<?php

use App\Models\Asset;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\AssetResource\Pages\PrintBarcode;

Route::get('/barcode', function () {
    $assets = Asset::all();
    return view('filament.resources.asset-resource.pages.print-barcode', compact('assets'));
})->name('barcode.all');

Route::get('/barcode/{asset}', function (Asset $asset) {
    $assets = collect([$asset]); // bungkus satu data jadi collection
    return view('filament.resources.asset-resource.pages.print-barcode', compact('assets'));
})->name('barcode.single');

// Redirect root ke Filament
Route::redirect('/', '/admin')->name('auth');

Route::get('/admin/assets/barcode/{record?}', PrintBarcode::class)->name('admin.assets.barcode');
