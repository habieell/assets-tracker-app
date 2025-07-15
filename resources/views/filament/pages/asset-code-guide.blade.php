<x-filament::page>
    <div class="prose max-w-full dark:prose-invert">
        <h1>Panduan Kode Aset</h1>

        <p>
            Kode aset digunakan untuk mengidentifikasi dan mengelompokkan aset perusahaan secara sistematis.
            Format standar kode aset di sistem ini adalah:
        </p>

        <pre><code>ICG/[DIVISI]/[KATEGORI]/[NO_ASET]/[MM-YYYY]</code></pre>

        <p><strong>Keterangan:</strong></p>
        <ul>
            <li><code>ICG</code> = Identitas perusahaan</li>
            <li><code>[DIVISI]</code> = Singkatan divisi (contoh: IT, GA)</li>
            <li><code>[KATEGORI]</code> = Kode kategori aset</li>
            <li><code>[NO_ASET]</code> = Nomor urut aset (4 digit)</li>
            <li><code>[MM-YYYY]</code> = Bulan dan tahun registrasi</li>
        </ul>

        <p><strong>Contoh:</strong></p>
        <ul>
            <li><code>ICG/IT/LAPTOP/0001/07-2025</code> → Laptop milik divisi IT</li>
            <li><code>ICG/GA/FURNITURE/0102/07-2025</code> → Meja kantor milik divisi GA</li>
        </ul>

        <h2>Kode Kategori Aset</h2>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Contoh Barang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MOBIL</td>
                    <td>Mobil</td>
                    <td>Mobil operasional</td>
                </tr>
                <tr>
                    <td>LAPTOP</td>
                    <td>Laptop</td>
                    <td>Laptop kerja</td>
                </tr>
                <tr>
                    <td>PRINTER</td>
                    <td>Printer</td>
                    <td>Printer Epson, Canon</td>
                </tr>
                <tr>
                    <td>AC</td>
                    <td>AC</td>
                    <td>AC Panasonic, Sharp</td>
                </tr>
                <tr>
                    <td>FURNITURE</td>
                    <td>Furniture</td>
                    <td>Meja, Kursi, Lemari</td>
                </tr>
                <tr>
                    <td>TV</td>
                    <td>Televisi</td>
                    <td>TV Samsung, LG</td>
                </tr>
                <tr>
                    <td>CCTV</td>
                    <td>Kamera CCTV</td>
                    <td>CCTV Dahua, Hikvision</td>
                </tr>
                <tr>
                    <td>HANDPHONE</td>
                    <td>Handphone</td>
                    <td>HP Samsung, iPhone</td>
                </tr>
            </tbody>
        </table>

        <h2>Tujuan Pengkodean</h2>
        <ul>
            <li>Mempermudah pelacakan dan pemeliharaan aset</li>
            <li>Mencegah duplikasi data</li>
            <li>Menstandarisasi pencatatan inventaris perusahaan</li>
            <li>Mempermudah pencarian, filtering, dan reporting</li>
        </ul>

        <p><strong>Catatan:</strong> Gunakan format kode sesuai standar di atas untuk semua aset yang didaftarkan.</p>
    </div>
</x-filament::page>