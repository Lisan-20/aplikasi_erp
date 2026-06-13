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
        DB::statement("CREATE VIEW dbo.fee_bidan_ri_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dokter, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.tc_trans_pelayanan.kode_bagian
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_bagian = '030501') AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%OLEH BIDAN%') AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_bidan_ri_v]");
    }
};
