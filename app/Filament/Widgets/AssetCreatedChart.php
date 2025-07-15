<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Asset;

class AssetCreatedChart extends ChartWidget
{
    protected static ?string $heading = 'Aset Dibuat per Bulan';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = collect(range(1, 12))->map(function ($month) {
            return Asset::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Aset Dibuat',
                    'data' => $data->toArray(),
                    'borderColor' => '#f59e0b',
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColumnSpan(): array
    {
        return [
            'md' => 12,
            'xl' => '1/2', // <-- tampil 1/2 lebar di layar besar
        ];
    }
}