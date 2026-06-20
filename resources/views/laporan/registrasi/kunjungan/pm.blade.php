<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN KUNJUNGAN PENUNJANG DIAGNOSTIK</title>
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
        <td colspan="3" class="title-main">LAPORAN KUNJUNGAN PASIEN PENUNJANG DIAGNOSTIK</td>
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
            <th rowspan="2">Instalasi</th>
            <th rowspan="2">Jumlah Pasien</th>
            <th colspan="8">Nasabah</th>
            <th colspan="2">Jen.Kelamin</th>
            <th colspan="2">Status Pasien</th>
            <th colspan="2">Status Pulang</th>
        </tr>
        <tr>
            <th>Pribadi</th>
            <th>BPJS PBI</th>
            <th>BPJS Non PBI</th>
            <th>BPJS COB</th>
            <th>BPJS KK</th>
            <th>Jamkesda</th>
            <th>Perusahaan</th>
            <th>Asuransi</th>
            <th>Laki2</th>
            <th>Wanita</th>
            <th>Lama</th>
            <th>Baru</th>
            <th>Rawat</th>
            <th>Pulang</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $row)
        <tr>
            <td class="text-center">{{ $index + 1 }}.</td>
            <td class="text-left">{{ $row['nama_bagian'] }}</td>
            <td class="text-right">{{ number_format($row['total_pasien'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['pribadi'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['bpjspbi'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['bpjsnp'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['bpjscob'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['bpjskk'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['jamkesda'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['perusahaan'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['asuransi'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['laki'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['perempuan'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['lama'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['baru'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['rawat'], 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($row['pulang'], 0, ',', '.') }}</td>
        </tr>
        @endforeach
        
        <tr style="background-color: #f9f9f9;">
            <td colspan="2" class="font-bold text-center">T o t a l</td>
            <td class="font-bold text-right">{{ number_format($total['total_pasien'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['pribadi'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['bpjspbi'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['bpjsnp'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['bpjscob'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['bpjskk'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['jamkesda'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['perusahaan'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['asuransi'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['laki'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['perempuan'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['lama'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['baru'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['rawat'], 0, ',', '.') }}</td>
            <td class="font-bold text-right">{{ number_format($total['pulang'], 0, ',', '.') }}</td>
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
