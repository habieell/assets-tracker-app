<?php

use App\Models\Asset;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\AssetResource\Pages\PrintBarcode;
use Barryvdh\DomPDF\Facade\Pdf;

Route::middleware(['web', 'auth'])->group(function () {

    // Halaman untuk menampilkan semua barcode aset
    Route::get('/barcode', function () {
        $assets = Asset::all();
        return view('filament.resources.asset-resource.pages.print-barcode', compact('assets'));
    })->name('barcode.all');

    // Halaman untuk menampilkan barcode satu aset
    Route::get('/barcode/{asset}', function (Asset $asset) {
        $assets = collect([$asset]); // Bungkus jadi collection
        return view('filament.resources.asset-resource.pages.print-barcode', compact('assets'));
    })->name('barcode.single');

    // Download Barcode Semua Aset sebagai PDF
    Route::get('/barcode/download/pdf', function () {
        $assets = Asset::all();
        $pdf = Pdf::loadView('filament.resources.asset-resource.pages.barcode-pdf', compact('assets'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('barcode-aset.pdf');
    })->name('barcode.download.pdf');

    // Download Barcode Berdasarkan ID Terpilih (optional)
    Route::get('/barcode/download/pdf/{ids?}', function ($ids = null) {
        $assets = $ids
            ? Asset::whereIn('id', explode(',', $ids))->get()
            : Asset::all();

        $pdf = Pdf::loadView('filament.resources.asset-resource.pages.barcode-pdf', compact('assets'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('barcode-aset-terpilih.pdf');
    })->name('barcode.download.selected');

    // Halaman Filament Print Barcode
    Route::get('/admin/assets/barcode/{record?}', PrintBarcode::class)
        ->name('admin.assets.barcode');
});

// Redirect root ke Filament Dashboard
Route::redirect('/', '/admin')->name('auth');