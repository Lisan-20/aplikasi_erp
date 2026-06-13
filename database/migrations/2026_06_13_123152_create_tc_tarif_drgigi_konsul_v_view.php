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
        DB::statement("CREATE VIEW dbo.tc_tarif_drgigi_konsul_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_dokter1, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_pelayanan.nama_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.nama_tindakan
HAVING      (SUM(dbo.tc_trans_pelayanan.bill_dr1) > 0)
ORDER BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_tarif_drgigi_konsul_v]");
    }
};
