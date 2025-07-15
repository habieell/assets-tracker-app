<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use Filament\Widgets\ChartWidget;

class AssetCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Aset per Kategori';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $categories = [
            'Elektronik' => 'AST-ELK-%',
            'Furniture'  => 'AST-FRN-%',
            'Jaringan'   => 'AST-NET-%',
            'Mobile'     => 'AST-MOB-%',
            'Utility'    => 'AST-UTL-%',
        ];

        $labels = [];
        $data = [];

        foreach ($categories as $label => $pattern) {
            $labels[] = $label;
            $data[] = Asset::where('code', 'like', $pattern)->count();
        }

        // Warna beda-beda per kategori
        $backgroundColors = [
            '#3b82f6', // Elektronik - biru
            '#10b981', // Furniture - hijau
            '#f59e0b', // Jaringan - kuning
            '#8b5cf6', // Mobile - ungu
            '#ef4444', // Utility - merah
        ];

        $borderColors = [
            '#2563eb', // lebih gelap
            '#059669',
            '#d97706',
            '#7c3aed',
            '#dc2626',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aset',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa juga pie/doughnut
    }

    public function getColumnSpan(): array
    {
        return [
            'md' => 12,
            'xl' => '1/2',
        ];
    }
}