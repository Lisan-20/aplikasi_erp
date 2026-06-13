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
        DB::statement("CREATE VIEW dbo.v_trans_obat_bebas_retur
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, SUM(CASE WHEN dbo.tc_trans_pelayanan.bill_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs END) AS bill_rs, 
                      SUM(CASE WHEN dbo.tc_trans_pelayanan.bill_rs_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs_jatah END) AS bill_rs_jatah, 
                      SUM(CASE WHEN dbo.tc_trans_pelayanan.lain_lain IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.lain_lain END) AS lain_lain, 
                      SUM(CASE WHEN dbo.tc_trans_pelayanan.jumlah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.jumlah END) AS jumlah, dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_jurnal, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan IN (11)) AND 
                      (dbo.tc_trans_kasir.seri_kuitansi IN ('AJ', 'RJ', 'NK')) AND (dbo.tc_trans_pelayanan.status_kredit = 1)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.tgl_ver, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok
HAVING      (dbo.tc_trans_pelayanan.no_registrasi = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_obat_bebas_retur]");
    }
};
