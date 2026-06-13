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
        DB::statement("CREATE VIEW dbo.v_dr_lab_ptass
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.flag_dr_lab, 
                      (dbo.tc_trans_pelayanan.bill_dr1 + dbo.tc_trans_pelayanan.bill_rs) * 1 / 100 AS bill_dr, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (NOT (dbo.tc_trans_pelayanan.kode_kelompok IN (1, 9, 8))) AND (dbo.tc_trans_pelayanan.kode_perusahaan > 0) AND (dbo.tc_trans_pelayanan.flag_dr_lab IS NULL) 
                      AND (dbo.tc_trans_pelayanan.kode_bagian = '050101') AND (NOT (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'admin%')) AND 
                      ((dbo.tc_trans_pelayanan.bill_dr1 + dbo.tc_trans_pelayanan.bill_rs) * 1 / 100 > 0) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_dr_lab_ptass]");
    }
};
