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
        DB::statement("CREATE OR ALTER VIEW dbo.xx_update_dokter_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, 
                      dbo.tc_trans_pelayanan.kode_dokter3, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_registrasi.kode_dokter
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_dokter1 IS NULL) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xx_update_dokter_v]");
    }
};
