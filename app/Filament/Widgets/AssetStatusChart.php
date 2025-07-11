<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use Filament\Widgets\ChartWidget;

class AssetStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Aset';
    protected static ?int $sort = 2; // urutan tampil setelah overview

    /**
     * Menentukan jenis chart.
     */
    protected function getType(): string
    {
        return 'doughnut';
    }

    /**
     * Menyediakan data chart.
     */
    protected function getData(): array
    {
        $labels = ['Aktif', 'Rusak', 'Dipindah'];

        $data = [
            Asset::where('status', 'aktif')->count(),
            Asset::where('status', 'rusak')->count(),
            Asset::where('status', 'dipindah')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aset',
                    'data' => $data,
                    'backgroundColor' => [
                        '#34D399', // Hijau - Aktif
                        '#F87171', // Merah - Rusak
                        '#60A5FA', // Biru - Dipindah
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * Lebar kolom chart pada grid Filament.
     */
    public function getColumnSpan(): array
    {
        return [
            'md' => 12,
            'xl' => '1/2',
        ];
    }
}
