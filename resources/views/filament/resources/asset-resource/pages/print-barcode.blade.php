<x-filament::page>
    <style>
        .barcode-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 6px;
            padding: 8px;
        }

        .barcode-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            padding: 6px;
            height: 130px;
            width: 130px;
        }

        .barcode-wrapper {
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .asset-code {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            margin-top: 5px;
            word-break: break-word;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 6mm;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                background: white !important;
                color: black !important;
                overflow: visible !important;
            }

            .print-header,
            header,
            .fi-topbar,
            .fi-sidebar,
            .fi-breadcrumbs,
            .fi-page-header {
                display: none !important;
            }

            .barcode-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(95px, 1fr));
                gap: 2px;
                justify-content: center;
                align-items: center;
                padding: 0;
            }

            .barcode-item {
                width: 95px;
                height: 95px;
                padding: 2px;
                border: 1px solid #ccc;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                transform: scale(0.95);
                transform-origin: top center;
            }

            .barcode-wrapper {
                width: 60px;
                height: 60px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 2px;
            }

            .barcode-wrapper svg {
                width: 60px !important;
                height: 60px !important;
            }

            .asset-code {
                font-size: 7px;
                text-align: center;
                line-height: 1.1;
                word-wrap: break-word;
            }
        }
    </style>

    <div class="flex justify-between items-center mb-2 print-header print:hidden">
        <h2 class="text-xl font-bold">Cetak QR Code Aset</h2>
        <button onclick="window.print()" class="bg-primary-600 text-white px-3 py-1 rounded text-sm">
            Print
        </button>
    </div>

    <div class="barcode-grid">
        @foreach ($assets as $asset)
        <div class="barcode-item">
            <div class="barcode-wrapper">
                {!! QrCode::size(100)->generate($asset->code) !!}
            </div>
            <div class="asset-code">{{ $asset->code }}</div>
        </div>
        @endforeach
    </div>
</x-filament::page>