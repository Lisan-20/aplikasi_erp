<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN KUNJUNGAN PERINATOLOGI</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        .title-table { width: 90%; margin: 0 auto 20px auto; border-collapse: collapse; }
        .title-table td { padding: 3px; }
        .title-main { font-size: 14px; font-weight: bold; text-align: center; }
        .title-sub { font-size: 12px; font-weight: bold; }
        
        .data-table { width: 90%; margin: 0 auto; border-collapse: collapse; border: 1px solid #000; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 4px; }
        .data-table th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        
        .footer-table { width: 90%; margin: 30px auto 0 auto; }
        .footer-table td { font-size: 10px; }
    </style>
</head>
<body>

<table class="title-table">
    <tr>
        <td colspan="3" class="title-main">LAPORAN KUNJUNGAN PERINATOLOGI</td>
    </tr>
    <tr>
        <td width="15%" class="title-sub">PERIODE</td>
        <td width="1%">:</td>
        <td class="font-bold" style="color: #000099;">{{ $periode }}</td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th rowspan="2" width="30">No.</th>
            <th rowspan="2">Jenis Perawatan</th>
            <th rowspan="2">Jumlah</th>
            <th colspan="2">Bayi Meninggal</th>
        </tr>
        <tr>
            <th>< 48 jam</th>
            <th>> 48 jam</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $index => $row)
        <tr>
            <td class="text-center">{{ $index + 1 }}.</td>
            <td class="text-left">{{ $row['bagian_asal'] }}</td>
            <td class="text-right">{{ number_format($row['jumlah_pasien'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['meninggal_krg'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['meninggal_lbh'], 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data untuk periode ini</td>
        </tr>
        @endforelse
        
        <tr style="background-color: #f9f9f9;">
            <td colspan="2" class="font-bold text-center">T o t a l</td>
            <td class="font-bold text-right">{{ number_format($total_pasien, 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total_meninggal_krg, 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total_meninggal_lbh, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

<table class="footer-table">
    <tr>
        <td>Dicetak Oleh : {{ session('username', 'System') }}</td>
    </tr>
    <tr>
        <td>Tanggal / Jam : {{ date('d-m-Y / H:i:s') }}</td>
    </tr>
</table>

@if($opsiCetak != '2')
<script>
    window.onload = function() {
        window.print();
    }
</script>
@endif

</body>
</html>
