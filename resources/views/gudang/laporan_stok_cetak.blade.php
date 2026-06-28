<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kartu Stok</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 18px; margin: 5px 0; }
        .header p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { display: flex; justify-content: space-between; margin-top: 40px; }
        .signature { text-align: center; width: 200px; }
        .signature p { margin-bottom: 60px; }
        @media print {
            body { margin: 0; }
            button { display: none; }
        }
        .btn-print { margin-bottom: 20px; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

    <button class="btn-print" onclick="window.print()">Cetak Halaman Ini</button>

    <div class="header">
        <h1>LAPORAN SALDO PERSEDIAAN (KARTU STOK)</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        <p>Gudang: {{ $nama_bagian }} ({{ $kode_bagian }})</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th class="text-right">Stok Awal</th>
                <th class="text-right">Masuk</th>
                <th class="text-right">Keluar</th>
                <th class="text-right">Stok Akhir</th>
                <th class="text-right">Harga HPP</th>
                <th class="text-right">Total Nilai</th>
                <th>Jenis / Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_input)->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->kode_brg }}</td>
                    <td>{{ $item->nama_brg }}</td>
                    <td class="text-right">{{ number_format($item->stok_awal, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $item->pemasukan > 0 ? '+'.number_format($item->pemasukan, 0, ',', '.') : '-' }}</td>
                    <td class="text-right">{{ $item->pengeluaran > 0 ? '-'.number_format($item->pengeluaran, 0, ',', '.') : '-' }}</td>
                    <td class="text-right"><strong>{{ number_format($item->stok_akhir, 0, ',', '.') }}</strong></td>
                    <td class="text-right">{{ $item->harga_hpp ? number_format($item->harga_hpp, 0, ',', '.') : '-' }}</td>
                    <td class="text-right"><strong>{{ $item->harga_hpp ? number_format($item->harga_hpp * $item->stok_akhir, 0, ',', '.') : '-' }}</strong></td>
                    <td>
                        <strong>{{ $jenisTransaksiMap[$item->jenis_transaksi] ?? 'Transaksi Lain' }}</strong><br>
                        <span style="color: #666; font-size: 11px;">{{ $item->keterangan ?? '-' }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Tidak ada pergerakan stok pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Mengetahui,</p>
            <br>
            <p><strong>( ______________________ )</strong><br>Kepala Gudang</p>
        </div>
        <div class="signature">
            <p>Dicetak Oleh,</p>
            <br>
            <p><strong>( ______________________ )</strong><br>Petugas Gudang</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Uncomment line below to auto-print on load
            // window.print();
        }
    </script>
</body>
</html>
