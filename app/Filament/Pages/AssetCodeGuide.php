<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AssetCodeGuide extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.asset-code-guide';

    protected static ?string $navigationGroup = 'Manajemen Aset';
    protected static ?string $title = 'Panduan Kode Barang';
    protected static ?int $navigationSort = 30;
}