<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.v_trans_far_ASKES_RI_retur
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, 
                      SUM(dbo.tc_trans_pelayanan.bill_rs_jatah) AS bill_rs_jatah, SUM(dbo.tc_trans_pelayanan.bill_dr1_jatah) AS bill_dr1_jatah, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr2_jatah) AS bill_dr2_jatah, SUM(dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, SUM(dbo.tc_trans_pelayanan.jumlah) AS jumlah, dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_jurnal, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (6, 7, 8))
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.kode_profit, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi
HAVING      (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_pelayanan.jenis_tindakan IN (11)) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 'RI')) AND 
                      (dbo.tc_registrasi.kode_perusahaan = 0 OR
                      dbo.tc_registrasi.kode_perusahaan IS NULL) AND (dbo.tc_trans_pelayanan.status_kredit = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_far_ASKES_RI_retur]");
    }
};
