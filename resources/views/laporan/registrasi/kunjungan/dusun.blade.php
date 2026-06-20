<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN SENSUS DUSUN</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        .title-table { width: 70%; margin: 0 auto 20px auto; border-collapse: collapse; }
        .title-table td { padding: 3px; }
        .title-main { font-size: 14px; font-weight: bold; text-align: center; }
        .title-sub { font-size: 12px; font-weight: bold; }
        
        .data-table { width: 70%; margin: 0 auto; border-collapse: collapse; border: 1px solid #000; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 4px; }
        .data-table th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        
        .footer-table { width: 70%; margin: 30px auto 0 auto; }
        .footer-table td { font-size: 10px; }
    </style>
</head>
<body>

<table class="title-table">
    <tr>
        <td colspan="3" class="title-main">LAPORAN REKAPITULASI SENSUS PASIEN BERDASARKAN DUSUN / ALAMAT</td>
    </tr>
    <tr>
        <td width="15%" class="title-sub">Periode</td>
        <td width="1%">:</td>
        <td>{{ $periode }}</td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Dusun / Alamat</th>
            <th width="150">Jumlah Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @forelse($data as $index => $row)
            @php $total += $row->jumlah; @endphp
            <tr>
                <td class="text-right">{{ $index + 1 }}.</td>
                <td class="text-left font-bold">{{ strtoupper($row->dusun) }}</td>
                <td class="text-right font-bold">{{ number_format($row->jumlah, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada data untuk periode ini</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-center font-bold">TOTAL (Top 100)</td>
            <td class="text-right font-bold">{{ number_format($total, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
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
