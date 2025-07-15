<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Tables\Actions\BulkAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Http\RedirectResponse;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print-filter')
                ->label('Print Sesuai Filter')
                ->icon('heroicon-o-printer')
                ->color('warning')
                ->url(function () {
                    $filters = request()->query('tableFilters');
                    return route('filament.admin.resources.assets.print-barcode') . ($filters ? '?' . http_build_query(['tableFilters' => $filters]) : '');
                }),

            Actions\CreateAction::make()->label('New Aset'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('print-selected')
                ->label('Print Terpilih')
                ->icon('heroicon-o-printer')
                ->color('warning')
                ->action(function (array $records): RedirectResponse {
                    $ids = implode(',', array_map(fn($record) => $record->id, $records));
                    return redirect()->to(route('filament.admin.resources.assets.print-barcode') . '?selected=' . $ids);
                }),
        ];
    }
}
