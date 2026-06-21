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
        DB::statement("CREATE OR ALTER VIEW dbo.v_kasir_pelayanan
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM(dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.flag_jurnal, 
                      dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.tunai, 
                      dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit
HAVING      (dbo.tc_trans_pelayanan.no_registrasi = 111954)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_kasir_pelayanan]");
    }
};
