<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN KUNJUNGAN RI NASABAH</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        .title-table { width: 95%; margin: 0 auto 20px auto; border-collapse: collapse; }
        .title-table td { padding: 3px; }
        .title-main { font-size: 14px; font-weight: bold; text-align: center; }
        .title-sub { font-size: 12px; font-weight: bold; }
        
        .data-table { width: 95%; margin: 0 auto; border-collapse: collapse; border: 1px solid #000; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 4px; }
        .data-table th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        .group-header { background-color: #e6f2ff; font-weight: bold; }
        
        .footer-table { width: 95%; margin: 30px auto 0 auto; }
        .footer-table td { font-size: 10px; }
    </style>
</head>
<body>

<table class="title-table">
    <tr>
        <td colspan="3" class="title-main">LAPORAN PASIEN DALAM PERAWATAN RAWAT INAP PER NASABAH</td>
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
            <th width="30">No.</th>
            <th>No. MR</th>
            <th>Nama Lengkap</th>
            <th>Umur (Thn)</th>
            <th>Ruang</th>
            <th>Kamar</th>
            <th>Kelas</th>
            <th>Tgl Masuk</th>
            <th>Diagnosa</th>
            <th>Dokter Rawat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $nasabah => $items)
            <tr class="group-header">
                <td colspan="10" class="text-left">NASABAH: {{ strtoupper($nasabah) }}</td>
            </tr>
            @foreach($items as $index => $row)
            <tr>
                <td class="text-center">{{ $index + 1 }}.</td>
                <td class="text-center">{{ $row['no_mr'] }}</td>
                <td class="text-left">{{ stripslashes($row['nama_pasien']) }}</td>
                <td class="text-center">{{ $row['umur'] }}</td>
                <td class="text-left">{{ $row['ruang'] }}</td>
                <td class="text-center">{{ $row['kamar'] }}</td>
                <td class="text-left">{{ $row['kelas'] }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($row['tgl_masuk'])->format('d-m-Y H:i:s') }}</td>
                <td class="text-left">{{ $row['diagnosa_awal'] }}</td>
                <td class="text-left">{{ $row['dr_merawat'] }}</td>
            </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="10" class="text-center">Tidak ada data untuk periode ini</td>
            </tr>
        @endforelse
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
