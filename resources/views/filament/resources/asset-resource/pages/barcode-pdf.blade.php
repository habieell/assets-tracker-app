<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Barcode Aset</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 6mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            font-size: 12px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 9%;
            /* (100 / 11) approx */
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ccc;
            padding: 2px;
            height: 95px;
        }

        img {
            width: 50px;
            height: 50px;
            display: block;
            margin: 0 auto 2px;
        }

        .asset-code {
            font-size: 6.5px;
            font-weight: bold;
            line-height: 1.1;
            text-align: center;
            white-space: pre-line;
        }
    </style>
</head>

<body>
    <h3>Cetak Barcode Aset</h3>
    <table>
        <tr>
            @foreach ($assets as $index => $asset)
            <td>
                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(100)->margin(0)->generate($asset->code)) }}">
                <div class="asset-code">{{ wordwrap($asset->code, 17, "\n", true) }}</div>
            </td>
            @if (($index + 1) % 11 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>