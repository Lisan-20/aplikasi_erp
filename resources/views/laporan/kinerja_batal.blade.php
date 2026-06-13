<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan Pasien Batal</title>
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
        <h2>Laporan Kunjungan Pasien Batal</h2>
    </div>

    <table class="info-table">
        <tr>
            <td width="150">PERIODE</td>
            <td width="10">:</td>
            <td style="color: #000099;">{{ $periodeStr }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th rowspan="3" width="30">No.</th>
                <th rowspan="3">Instalasi</th>
                <th rowspan="3">Jumlah Pasien</th>
                <th colspan="8">Nasabah</th>
                <th colspan="2">Jen.Kelamin</th>
                <th colspan="2">Usia</th>
                <th colspan="2">Status Pasien</th>
            </tr>
            <tr>
                <th rowspan="2">Umum</th>
                <th rowspan="2">JAMKESDA</th>
                <th rowspan="2">Perusahaan</th>
                <th rowspan="2">Asuransi</th>
                <th colspan="4">BPJS</th>
                <th rowspan="2">Laki2</th>
                <th rowspan="2">Wanita</th>
                <th rowspan="2">Anak</th>
                <th rowspan="2">Dewasa</th>
                <th rowspan="2">Lama</th>
                <th rowspan="2">Baru</th>
            </tr>
            <tr>
                <th>PBI</th>
                <th>NON PBI</th>
                <th>COB</th>
                <th>KETENAGA KERJAAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tot_jumlah = 0; $tot_pribadi = 0; $tot_jamkesda = 0; $tot_perusahaan = 0; $tot_asuransi = 0;
                $tot_bpjspbi = 0; $tot_bpjsnp = 0; $tot_bpjscob = 0; $tot_jampersal = 0;
                $tot_laki = 0; $tot_perempuan = 0; $tot_anak = 0; $tot_dewasa = 0; $tot_lama = 0; $tot_baru = 0;
            @endphp
            @forelse($data as $key => $row)
                @php
                    $tot_jumlah += $row->jumlah_pasien;
                    $tot_pribadi += $row->pribadi;
                    $tot_jamkesda += $row->jamkesda;
                    $tot_perusahaan += $row->perusahaan;
                    $tot_asuransi += $row->asuransi;
                    $tot_bpjspbi += $row->bpjspbi;
                    $tot_bpjsnp += $row->bpjsnp;
                    $tot_bpjscob += $row->bpjscob;
                    $tot_jampersal += $row->jampersal;
                    $tot_laki += $row->laki;
                    $tot_perempuan += $row->perempuan;
                    $tot_anak += $row->anak;
                    $tot_dewasa += $row->dewasa;
                    $tot_lama += $row->lama;
                    $tot_baru += $row->baru;
                @endphp
                <tr>
                    <td class="text-right">{{ $key + 1 }}.</td>
                    <td class="text-left">{{ $row->nama_bagian }}</td>
                    <td class="text-right">{{ $row->jumlah_pasien ?: '0' }}</td>
                    <td class="text-right">{{ $row->pribadi ?: '0' }}</td>
                    <td class="text-right">{{ $row->jamkesda ?: '0' }}</td>
                    <td class="text-right">{{ $row->perusahaan ?: '0' }}</td>
                    <td class="text-right">{{ $row->asuransi ?: '0' }}</td>
                    <td class="text-right">{{ $row->bpjspbi ?: '0' }}</td>
                    <td class="text-right">{{ $row->bpjsnp ?: '0' }}</td>
                    <td class="text-right">{{ $row->bpjscob ?: '0' }}</td>
                    <td class="text-right">{{ $row->jampersal ?: '0' }}</td>
                    <td class="text-right">{{ $row->laki ?: '0' }}</td>
                    <td class="text-right">{{ $row->perempuan ?: '0' }}</td>
                    <td class="text-right">{{ $row->anak ?: '0' }}</td>
                    <td class="text-right">{{ $row->dewasa ?: '0' }}</td>
                    <td class="text-right">{{ $row->lama ?: '0' }}</td>
                    <td class="text-right">{{ $row->baru ?: '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="17">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="font-weight:bold; background-color: #f9f9f9;">
                <td colspan="2" class="text-left">T o t a l</td>
                <td class="text-right">{{ $tot_jumlah ?: '0' }}</td>
                <td class="text-right">{{ $tot_pribadi ?: '0' }}</td>
                <td class="text-right">{{ $tot_jamkesda ?: '0' }}</td>
                <td class="text-right">{{ $tot_perusahaan ?: '0' }}</td>
                <td class="text-right">{{ $tot_asuransi ?: '0' }}</td>
                <td class="text-right">{{ $tot_bpjspbi ?: '0' }}</td>
                <td class="text-right">{{ $tot_bpjsnp ?: '0' }}</td>
                <td class="text-right">{{ $tot_bpjscob ?: '0' }}</td>
                <td class="text-right">{{ $tot_jampersal ?: '0' }}</td>
                <td class="text-right">{{ $tot_laki ?: '0' }}</td>
                <td class="text-right">{{ $tot_perempuan ?: '0' }}</td>
                <td class="text-right">{{ $tot_anak ?: '0' }}</td>
                <td class="text-right">{{ $tot_dewasa ?: '0' }}</td>
                <td class="text-right">{{ $tot_lama ?: '0' }}</td>
                <td class="text-right">{{ $tot_baru ?: '0' }}</td>
            </tr>
        </tfoot>
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
