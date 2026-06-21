<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FarmasiPoliController extends Controller
{
    private function pembulatan($txt_biaya_tebus)
    {
        $harga_jual_1 = substr((string) $txt_biaya_tebus, -3, 3);
        $hrg_bulat = (int) $harga_jual_1;

        if ($hrg_bulat > 0 && $hrg_bulat < 500) {
            $harga_jual_2 = 500;
            $harga_jual_ok = $txt_biaya_tebus - $hrg_bulat;
        } elseif ($hrg_bulat > 500 && $hrg_bulat < 1000) {
            $harga_jual_2 = 1000;
            $harga_jual_ok = $txt_biaya_tebus - $hrg_bulat;
        } else {
            $harga_jual_2 = $hrg_bulat;
            $harga_jual_ok = $txt_biaya_tebus;
        }
        $harga_3 = $harga_jual_ok;
        $harga_jual_4 = $harga_3 + $harga_jual_2;

        return $harga_jual_4;
    }

    /**
     * Get patient header metadata
     */
    private function getPatientData($kode_poli)
    {
        $pasien = DB::table('pl_mt_pasien_v')
            ->where('id_pl_tc_poli', $kode_poli)
            ->orWhere('kode_poli', $kode_poli)
            ->first();

        if (! $pasien) {
            abort(404, 'Data Pasien tidak ditemukan');
        }

        // Determine Nasabah/Penanggung
        $nm_nasabah = '';
        if ($pasien->kode_kelompok == 1) {
            $nasabah = DB::table('mt_nasabah')->where('kode_kelompok', $pasien->kode_kelompok)->first();
            $nm_nasabah = $nasabah ? $nasabah->nama_kelompok : '';
        } elseif (in_array($pasien->kode_kelompok, [3, 5, 11])) {
            $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $pasien->kode_perusahaan)->first();
            $nm_nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
            if ($pasien->kode_kelompok == 11) {
                $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', 11)->first();
                $nm_nasabah = ($kelompok ? $kelompok->nama_kelompok.' ' : '').$nm_nasabah;
            }
        } else {
            $nasabah = DB::table('mt_nasabah')->where('kode_kelompok', $pasien->kode_kelompok)->first();
            $nm_nasabah = $nasabah ? $nasabah->nama_kelompok : '';
        }

        $nama_penanggung = '';
        if ($pasien->kode_penanggung && is_numeric($pasien->kode_penanggung) && $pasien->kode_penanggung > 0) {
            $penanggung = DB::table('mt_perusahaan')->where('kode_perusahaan', $pasien->kode_penanggung)->first();
            $nama_penanggung = $penanggung ? $penanggung->nama_perusahaan : '';
        }

        $umur = $pasien->tgl_lhr ? Carbon::parse($pasien->tgl_lhr)->age : 0;

        return [
            'kode_poli' => $kode_poli,
            'no_mr' => $pasien->no_mr ?? '',
            'nama_pasien' => $pasien->nama_pasien ?? '',
            'umur' => $umur,
            'jen_kelamin' => ($pasien->jen_kelamin ?? 1) == 1 ? 'Laki-laki' : 'Perempuan',
            'gol_darah' => $pasien->gol_darah ?? '-',
            'no_registrasi' => $pasien->no_registrasi ?? null,
            'no_kunjungan' => $pasien->no_kunjungan ?? null,
            'nama_bagian' => $pasien->nama_bagian ?? '',
            'nm_poli' => $pasien->nama_poli ?? ($pasien->nama_bagian ?? ''),
            'kode_bagian' => $pasien->kode_bagian ?? '',
            'nama_dokter' => $pasien->nama_dokter ?? ($pasien->nama_pegawai ?? ''),
            'kode_dokter' => $pasien->kode_dokter ?? '',
            'tgl_kunjungan' => $pasien->tgl_kunjungan ?? '',
            'nm_nasabah' => $nm_nasabah,
            'penanggung' => $nama_penanggung,
            'kode_kelompok' => $pasien->kode_kelompok ?? '',
            'kode_perusahaan' => $pasien->kode_perusahaan ?? '',
            'kode_klas' => $pasien->kode_klas ?? '',
            'status_selesai' => $pasien->status_selesai ?? 0,
        ];
    }

    public function index($kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        // Ambil data Obat (Stok Depo Farmasi RJ = 060101)
        // Gabung mt_barang dengan mt_depo_stok
        $obatList = DB::table('mt_depo_stok')
            ->join('mt_barang', 'mt_barang.kode_brg', '=', 'mt_depo_stok.kode_brg')
            ->select('mt_barang.kode_brg', 'mt_barang.nama_brg', 'mt_barang.satuan_kecil', 'mt_depo_stok.jml_sat_kcl')
            ->where('mt_depo_stok.kode_bagian', '060101') // Farmasi RJ
            ->where('mt_depo_stok.jml_sat_kcl', '>', 0) // Hanya tampilkan yg ada stok
            ->orderBy('mt_barang.nama_brg')
            ->get();

        // Master Takaran & Penggunaan
        $takaranList = DB::table('mt_takaran')->orderBy('takaran')->get();
        $penggunaanList = DB::table('mt_penggunaan')->orderBy('id')->get();

        // Ambil Data Resep Pasien Saat Ini
        // Join fr_tc_far_detail dengan fr_tc_far dengan mt_barang
        $resepList = DB::table('fr_tc_far_detail')
            ->join('fr_tc_far', 'fr_tc_far.kode_trans_far', '=', 'fr_tc_far_detail.kode_trans_far')
            ->join('mt_barang', 'mt_barang.kode_brg', '=', 'fr_tc_far_detail.kode_brg')
            ->leftJoin('mt_takaran', 'mt_takaran.id_takaran', '=', 'fr_tc_far_detail.takaran')
            ->leftJoin('mt_penggunaan', 'mt_penggunaan.id', '=', 'fr_tc_far_detail.penggunaan')
            ->select(
                'fr_tc_far_detail.kd_tr_resep',
                'mt_barang.nama_brg',
                'mt_barang.satuan_kecil',
                'fr_tc_far_detail.jumlah_pesan',
                'fr_tc_far_detail.harga_jual',
                'fr_tc_far_detail.biaya_tebus',
                'fr_tc_far_detail.harga_r',
                'fr_tc_far_detail.jml_pakai',
                'fr_tc_far_detail.jml_takar',
                'mt_takaran.takaran as nama_takaran',
                'mt_penggunaan.penggunaan as nama_penggunaan',
                'fr_tc_far_detail.instruksi'
            )
            ->where('fr_tc_far.no_kunjungan', $patient['no_kunjungan'])
            ->where('fr_tc_far.status_transaksi', 1)
            ->orderBy('fr_tc_far_detail.kd_tr_resep', 'desc')
            ->get();

        // Data Transaksi Farmasi
        $transaksiFar = DB::table('fr_tc_far')
            ->where('no_kunjungan', $patient['no_kunjungan'])
            ->where('status_transaksi', 1)
            ->orderBy('kode_trans_far', 'desc')
            ->first();

        return Inertia::render('Poli/Tabs/FarmasiTab', [
            'patient' => $patient,
            'obatList' => $obatList,
            'takaranList' => $takaranList,
            'penggunaanList' => $penggunaanList,
            'resepList' => $resepList,
            'transaksiFar' => $transaksiFar,
        ]);
    }

    public function store(Request $request, $kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);
        $kode_profit = 2000; // RJ

        $kode_brg = $request->input('kode_brg');
        $jumlah = $request->input('jumlah', 1);

        if (! $kode_brg) {
            return redirect()->back()->withErrors(['kode_brg' => 'Pilih obat terlebih dahulu']);
        }

        DB::beginTransaction();
        try {
            // 1. Cek / Buat Header fr_tc_far
            $frTcFar = DB::table('fr_tc_far')
                ->where('no_kunjungan', $patient['no_kunjungan'])
                ->where('kode_profit', $kode_profit)
                ->where('status_transaksi', 1) // asumsi 1 = open? di script lama tidak pakai filter ini, tapi cari yg aktif
                ->orderBy('kode_trans_far', 'desc')
                ->first();

            $kode_trans_far = $frTcFar ? $frTcFar->kode_trans_far : null;

            if (! $kode_trans_far) {
                // Buat Header Baru
                $kode_trans_far = DB::table('fr_tc_far')->max('kode_trans_far') + 1;
                $kode_form_rj = DB::table('fr_tc_far')->where('kode_profit', $kode_profit)->max('kode_form_rj') + 1;
                $kd_blkg = date('dmY');
                $no_form = $kode_form_rj.'/RJ-'.$kd_blkg;

                DB::table('fr_tc_far')->insert([
                    'kode_trans_far' => $kode_trans_far,
                    'kode_pesan_resep' => 0,
                    'kode_form_ri' => 0,
                    'kode_form_rj' => $kode_form_rj,
                    'kode_form_rl' => 0,
                    'kode_form_bb' => 0,
                    'kode_form_baksos' => 0,
                    'no_resep' => $no_form,
                    'tgl_trans' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'petugas' => auth()->id() ?: 0,
                    'no_mr' => $patient['no_mr'],
                    'no_registrasi' => $patient['no_registrasi'],
                    'no_kunjungan' => $patient['no_kunjungan'],
                    'kode_dokter' => $patient['kode_dokter'],
                    'nama_pasien' => $patient['nama_pasien'],
                    'alamat_pasien' => $patient['almt_ttp_pasien'] ?? '',
                    'telpon_pasien' => $patient['tlp_almt_ttp'] ?? '',
                    'dokter_pengirim' => $patient['nama_pegawai'] ?? '',
                    'kode_bagian' => '060101', // Farmasi RJ
                    'kode_bagian_asal' => $patient['kode_bagian'],
                    'kode_profit' => $kode_profit,
                    'kode_klas' => $patient['kode_klas'] ?: 16,
                    'no_reg_resep' => $patient['no_registrasi'],
                    'status_transaksi' => 1,
                ]);
            }

            // 2. Kalkulasi Harga
            $stok = DB::table('mt_depo_stok')->where('kode_brg', $kode_brg)->where('kode_bagian', '060101')->first();
            $barang = DB::table('mt_barang')->where('kode_brg', $kode_brg)->first();

            $harga_beli = $barang ? ($barang->harga_satuan ?? 0) : 0;
            $kode_layanan = trim($barang->kode_layanan ?? '');
            $golongan = $barang->obat_khusus ?? '';

            $kode_profit_margin = $kode_profit;
            // Jika injeksi atau racikan (di skip dulu racikan)
            if ($kode_layanan == 'GP') {
                $kode_profit_margin = 5000;
            }

            $nilai_profit = DB::table('fr_mt_profit_margin')
                ->where('kode_profit', $kode_profit_margin)
                ->where('golongan', $golongan)
                ->where('kode_kelompok', $patient['kode_kelompok'])
                ->value('profit_obat');

            if (! $nilai_profit || $nilai_profit == 0) {
                $nilai_profit = 50; // default 50%
            }

            $besar_profit = ($nilai_profit * 0.01) + 1;
            $harga_jual = round($harga_beli * $besar_profit);

            // Embalase/Service
            $txt_service = 300; // default
            $obat_racikan = ['D01A02460', 'D01A02461', 'D01A02462', 'D01A02463', 'D01A02464', 'D01A02465', 'D01A02466', 'D01A02467', 'D01A02763'];
            if (in_array($kode_brg, $obat_racikan)) {
                if ($kode_brg == 'D01A02467') {
                    $txt_service = 3000 + (200 * $jumlah);
                } else {
                    $txt_service = 3000;
                }
            }

            $txt_biaya_tebus = $harga_jual * $jumlah;
            if ($kode_brg == 'D01A02467') {
                $txt_biaya_tebus_blt = $this->pembulatan($txt_biaya_tebus);
                $txt_biaya_tebus_bulat = $txt_biaya_tebus_blt;
            } else {
                $txt_biaya_tebus_serv = $txt_biaya_tebus + $txt_service;
                $txt_biaya_tebus_blt = $this->pembulatan($txt_biaya_tebus_serv);
                $txt_biaya_tebus_bulat = $txt_biaya_tebus_blt - $txt_service;
            }

            // 3. Insert Detail
            $kd_tr_resep = DB::table('fr_tc_far_detail')->max('kd_tr_resep') + 1;

            DB::table('fr_tc_far_detail')->insert([
                'kd_tr_resep' => $kd_tr_resep,
                'kode_trans_far' => $kode_trans_far,
                'jumlah_pesan' => $jumlah,
                'jumlah_tebus' => $jumlah,
                'biaya_tebus' => $txt_biaya_tebus_bulat,
                'sisa' => 0,
                'kode_brg' => $kode_brg,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'harga_r' => $txt_service,
                'kode_cito' => 0, // Biasa
                'jml_pakai' => $request->input('jml_pakai') ?: '',
                'jml_takar' => $request->input('jml_takar') ?: '',
                'takaran' => $request->input('id_takaran') ?: 0,
                'penggunaan' => $request->input('id_penggunaan') ?: 0,
                'instruksi' => $request->input('txt_instruksi', '-'),
                'racik' => in_array($kode_brg, $obat_racikan) ? 1 : 0,
                'obat_cover_persh' => 0,
                'profit_2_persen' => 0,
                'tgl_input' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ]);

            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan obat: '.$e->getMessage()]);
        }
    }

    public function destroyResep($kode_poli, $kd_tr_resep)
    {
        $patient = $this->getPatientData($kode_poli);

        DB::table('fr_tc_far_detail')->where('kd_tr_resep', $kd_tr_resep)->delete();

        return redirect()->back()->with('success', 'Obat berhasil dihapus dari resep');
    }

    /**
     * Resep Selesai - mengirim ke antrian apotek
     */
    public function selesaiResep($kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        // Update status_transaksi = null agar masuk ke antrian apotek (far_antrian_resep_rajal)
        DB::table('fr_tc_far')
            ->where('no_kunjungan', $patient['no_kunjungan'])
            ->where('status_transaksi', 1)
            ->update(['status_transaksi' => null]);

        return redirect()->back()->with('success', 'Resep berhasil dikirim ke Apotek.');
    }
}
