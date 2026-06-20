<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rujukan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 5px 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 2px; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .data-table th, .data-table td { border: 1px solid #333; padding: 4px; text-align: center; }
        .data-table th { background-color: #f2f2f2; font-weight: bold; }
        .data-table td.text-left { text-align: left; }
        .data-table td.text-right { text-align: right; }
        .footer { margin-top: 30px; width: 100%; }
        .footer td { text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Rujukan/Kiriman Pasien</h2>
    </div>

    <table class="info-table">
        <tr>
            <td width="150">Asal Pasien</td>
            <td width="10">:</td>
            <td>{{ $asal_pasien_str }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ $periodeStr }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="30">No.</th>
                <th>No MR</th>
                <th>Nama Pasien</th>
                <th>Tanggal Masuk</th>
                <th>Bagian</th>
                <th>Asal</th>
                <th>Perujuk</th>
                <th>Wilayah</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $row)
                <tr>
                    <td class="text-right">{{ $key + 1 }}.</td>
                    <td class="text-center">{{ $row->no_mr }}</td>
                    <td class="text-left">{{ $row->nama_pasien }}</td>
                    <td class="text-center">{{ date('d-m-Y', strtotime($row->tgl_jam_masuk)) }}</td>
                    <td class="text-left">{{ $row->nama_bagian }}</td>
                    <td class="text-left">{{ $row->asal_pasien }}</td>
                    <td class="text-left">{{ $row->detail }}</td>
                    <td class="text-left">{{ $row->wilayah }}</td>
                    <td class="text-left">{{ $row->tindakan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="footer">
        <tr>
            <td>Dicetak Oleh : {{ auth()->user()->username ?? 'System' }}</td>
        </tr>
        <tr>
            <td>Tanggal / Jam : {{ date('d-m-Y') }} / {{ date('H:i:s') }}</td>
        </tr>
    </table>
</body>
</html>
