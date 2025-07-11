<x-filament::page>
    <style>
        * {
            box-sizing: border-box;
        }

        .barcode-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            padding: 10px;
        }

        .barcode-item {
            border: 1px solid #ccc;
            padding: 6px;
            font-size: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100px; /* Tinggi konsisten */
            page-break-inside: avoid;
        }

        .barcode-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 4px;
            padding: 0 4px;
        }

        .barcode-logo {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        .asset-code {
            font-size: 11px;
            text-align: right;
            flex: 1;
        }

        .barcode-wrapper {
            margin-top: 4px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .barcode-wrapper img {
            max-width: 100%;
            height: auto;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 8mm;
            }

            html, body {
                margin: 0;
                padding: 0;
                width: auto;
                height: auto;
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
                grid-template-columns: repeat(6, 1fr);
                gap: 6px;
                padding: 10px;
                margin: 0;
                width: 100%;
            }

            .barcode-item {
                height: 100px; /* Sama seperti di tampilan */
                padding: 6px;
                border: 1px solid #ccc;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                box-sizing: border-box;
            }

            .barcode-logo {
                width: 30px;
                height: 30px;
            }

            .asset-code {
                font-size: 11px;
            }

            .barcode-wrapper {
                margin-top: 4px;
                transform: none;
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .barcode-wrapper img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>

    <div class="flex justify-between items-center mb-2 print-header print:hidden">
        <h2 class="text-xl font-bold">Cetak Barcode Aset</h2>
        <button onclick="window.print()" class="bg-primary-600 text-white px-3 py-1 rounded text-sm">
            Print
        </button>
    </div>

    <div class="barcode-grid">
        @foreach ($assets as $asset)
        <div class="barcode-item">
            <div class="barcode-header">
                <img src="{{ asset('images/ic-logo.png') }}" alt="Logo" class="barcode-logo" />
                <div class="asset-code">{{ $asset->code }}</div>
            </div>
            <div class="barcode-wrapper">
                {!! (new Milon\Barcode\DNS1D)->getBarcodeHTML($asset->code, 'C128', 1, 40) !!}
            </div>
        </div>
        @endforeach
    </div>
</x-filament::page>