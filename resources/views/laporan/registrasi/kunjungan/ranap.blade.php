<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN KUNJUNGAN RAWAT INAP</title>
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
        
        .footer-table { width: 95%; margin: 30px auto 0 auto; }
        .footer-table td { font-size: 10px; }
    </style>
</head>
<body>

<table class="title-table">
    <tr>
        <td colspan="3" class="title-main">LAPORAN PASIEN PULANG RAWAT INAP</td>
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
            <th>Nama Pasien</th>
            <th>No. Registrasi</th>
            <th>L/P</th>
            <th>Nasabah</th>
            <th>Umur</th>
            <th>Ruangan</th>
            <th>Kelas</th>
            <th>Bed</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Dokter DPJP</th>
            <th>Status Pasien</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $index => $row)
        <tr>
            <td class="text-center">{{ $index + 1 }}.</td>
            <td class="text-center">{{ $row['no_mr'] }}</td>
            <td class="text-left">{{ stripslashes($row['nama_pasien']) }}</td>
            <td class="text-center">{{ $row['no_registrasi'] }}</td>
            <td class="text-center">{{ $row['gender'] }}</td>
            <td class="text-left">{{ $row['nasabah'] }}</td>
            <td class="text-center">{{ $row['umur'] }}</td>
            <td class="text-left">{{ $row['nama_bagian'] }}</td>
            <td class="text-left">{{ $row['nama_klas'] }}</td>
            <td class="text-left">{{ $row['kamar'] }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($row['tgl_masuk'])->format('d-m-Y H:i:s') }}</td>
            <td class="text-center">{{ $row['tgl_keluar'] ? \Carbon\Carbon::parse($row['tgl_keluar'])->format('d-m-Y H:i:s') : '' }}</td>
            <td class="text-left">{{ $row['dokter'] }}</td>
            <td class="text-center">{{ $row['stat_pasien'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="14" class="text-center">Tidak ada data untuk periode ini</td>
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
