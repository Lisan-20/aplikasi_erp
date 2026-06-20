<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN KUNJUNGAN HARIAN</title>
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
        <td colspan="3" class="title-main">LAPORAN KUNJUNGAN DETAIL RAWAT JALAN</td>
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
            <th>Tanggal</th>
            <th>Poliklinik/UGD</th>
            <th>Dokter</th>
            <th>No Mr</th>
            <th>Nama Pasien</th>
            <th>Nasabah</th>
            <th>Nama PT</th>
            <th>Jns Kelamin</th>
            <th>Usia</th>
            <th>Status Pulang</th>
            <th>User Daftar</th>
            <th>Status Pasien</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $index => $row)
        <tr>
            <td class="text-center">{{ $index + 1 }}.</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($row['tgl_masuk'])->format('d-m-Y H:i:s') }}</td>
            <td class="text-left">{{ $row['bagian'] }}</td>
            <td class="text-left">{{ $row['dokter'] }}</td>
            <td class="text-center">{{ $row['no_mr'] }}</td>
            <td class="text-left">{{ stripslashes($row['nama_pasien']) }}</td>
            <td class="text-left">{{ $row['nasabah'] }}</td>
            <td class="text-left">{{ $row['perusahaan'] }}</td>
            <td class="text-left">{{ $row['jen_kelamin'] }}</td>
            <td class="text-center">{{ $row['umur'] }}</td>
            <td class="text-center">{{ $row['status_pulang'] }}</td>
            <td class="text-left">{{ $row['user_daftar'] }}</td>
            <td class="text-left">{{ $row['stat_pasien'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="13" class="text-center">Tidak ada data untuk periode ini</td>
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
