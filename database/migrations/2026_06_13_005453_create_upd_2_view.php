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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_2
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_klas, dbo.mt_master_tarif_detail_bpjs.kode_klas AS Expr1, 
                      dbo.mt_master_tarif_detail_bpjs.bill_rs AS rs, dbo.mt_master_tarif_detail_bpjs.bill_dr1 AS dr, dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail_bpjs ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_bpjs.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 171183) AND (dbo.mt_master_tarif_detail_bpjs.kode_klas = 7) AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND 
                      (NOT (dbo.tc_trans_pelayanan.kode_bagian LIKE '05%')) AND (dbo.tc_trans_pelayanan.kode_bagian NOT LIKE '0309%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_2]");
    }
};
