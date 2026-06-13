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
        DB::statement("CREATE VIEW dbo.v_trans_adm_ass_RI_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, 
                      dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_klas, 
                      dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.tgl_ver, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, dbo.mt_perusahaan.flag
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan IN (2)) AND 
                      (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 'RI')) AND (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.tc_registrasi.kode_perusahaan > 0) AND 
                      (dbo.mt_perusahaan.flag = 1) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_adm_ass_RI_v]");
    }
};
