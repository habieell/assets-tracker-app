<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }

        table td:first-child {
            font-weight: bold;
            width: 180px;
        }

        /* Layout gambar & QR */
        .images {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .image-box,
        .qr-section {
            text-align: center;
            flex: 1;
            max-width: 250px;
        }

        .image-box img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #fff;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-back {
            background: #007bff;
            color: white;
        }

        .btn-print {
            background: #28a745;
            color: white;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                background: white;
            }

            .btn-container {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Aset</h2>
        <table>
            <tr>
                <td>Kode</td>
                <td>{{ $asset->code }}</td>
            </tr>
            <tr>
                <td>Nama Aset</td>
                <td>{{ $asset->name }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>{{ $asset->category }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ ucfirst($asset->status) }}</td>
            </tr>
            <tr>
                <td>Data Owner</td>
                <td>{{ $asset->division_owner }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>{{ $asset->location }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>{{ $asset->penanggung_jawab }}</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>{{ $asset->description }}</td>
            </tr>
        </table>

        <div class="images">
            <div class="image-box">
                <p><strong>Asset Image</strong></p>
                @if($asset->asset_image)
                <img src="{{ asset('storage/'.$asset->asset_image) }}" alt="Asset Image">
                @else
                <p>-</p>
                @endif
            </div>
        </div>

        <div class="btn-container no-print">
            <button onclick="window.history.back()" class="btn btn-back">← Kembali</button>
            <button onclick="window.print()" class="btn btn-print">🖨 Print</button>
        </div>
    </div>
</body>

</html>