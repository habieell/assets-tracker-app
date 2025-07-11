<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AssetOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Aset', Asset::count())
                ->description('Seluruh aset tercatat')
                ->color('primary'),

            Stat::make('Aset Aktif', Asset::where('status', 'aktif')->count())
                ->description('Digunakan saat ini')
                ->color('success'),

            Stat::make('Aset Rusak', Asset::where('status', 'rusak')->count())
                ->description('Perlu perbaikan')
                ->color('danger'),

            Stat::make('Aset Dipindah', Asset::where('status', 'dipindah')->count())
                ->description('Sudah dipindahkan')
                ->color('warning'),
        ];
    }

    protected function getColumns(): int
    {
        return 4; // total 4 kolom per baris untuk stat
    }
}
