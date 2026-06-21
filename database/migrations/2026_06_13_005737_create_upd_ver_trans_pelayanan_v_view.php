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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_ver_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_pelayanan.flag_jurnal
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.no_induk > 0) AND (dbo.tc_trans_kasir.kode_shift > 0) AND (dbo.tc_trans_kasir.kode_loket > 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_pelayanan.tgl_ver IS NULL) AND (dbo.tc_trans_pelayanan.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ver_trans_pelayanan_v]");
    }
};
