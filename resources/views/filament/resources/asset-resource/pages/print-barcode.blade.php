<x-filament::page>
    <style>
        @media print {
            body, html {
                margin: 0;
                padding: 0;
            }

            header,
            nav,
            aside,
            .print-header,
            .fi-topbar,
            .fi-sidebar,
            .fi-breadcrumbs,
            .fi-page-header,
            .fi-section,
            .fi-header,
            .fi-page-title {
                display: none !important;
            }

            .barcode-grid {
                display: grid !important;
                grid-template-columns: repeat(5, 1fr) !important;
                gap: 4px !important;
                margin: 0;
            }

            .barcode-item {
                border: 1px solid #ccc;
                padding: 4px !important;
                font-size: 10px;
                text-align: center;
                page-break-inside: avoid;
            }

            .barcode-wrapper {
                transform: scale(0.85);
                transform-origin: top center;
                margin-top: 4px;
            }

            .barcode-wrapper img {
                max-width: 100%;
                height: auto;
            }
        }

        .barcode-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 6px;
        }

        .barcode-item {
            border: 1px solid #ccc;
            padding: 4px;
            font-size: 10px;
            text-align: center;
        }

        .barcode-wrapper {
            display: inline-block;
            transform: scale(1);
            transform-origin: center;
            margin-top: 4px;
        }

        .barcode-wrapper img {
            max-width: 100%;
            height: auto;
        }

        .asset-name {
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .asset-code {
            font-size: 9px;
            color: #666;
        }
    </style>

    {{-- Header tombol print --}}
    <div class="flex justify-between items-center mb-2 print-header print:hidden">
        <h2 class="text-xl font-bold">Cetak Barcode Aset</h2>
        <button onclick="window.print()" class="bg-primary-600 text-white px-3 py-1 rounded text-sm">
            Print
        </button>
    </div>

    {{-- Grid Barcode --}}
    <div class="barcode-grid">
        @foreach ($assets as $asset)
            <div class="barcode-item">
                <div class="asset-name">{{ $asset->name }}</div>
                <div class="asset-code">{{ $asset->code }}</div>
                <div class="barcode-wrapper">
                    {!! (new Milon\Barcode\DNS1D)->getBarcodeHTML($asset->code, 'C128', 1, 40) !!}
                </div>
            </div>
        @endforeach
    </div>
</x-filament::page>