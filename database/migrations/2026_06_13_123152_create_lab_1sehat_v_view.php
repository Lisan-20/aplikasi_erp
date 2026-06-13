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
        DB::statement("CREATE VIEW dbo.lab_1sehat_v
AS
SELECT     dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.tgl_daftar, dbo.tc_registrasi.no_registrasi, dbo.pm_tc_penunjang.asal_daftar, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, YEAR(dbo.pm_tc_penunjang.tgl_daftar) AS Expr1
FROM         dbo.pm_tc_penunjang INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_penunjang.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.pm_tc_penunjang.kode_bagian = '050101') AND (YEAR(dbo.pm_tc_penunjang.tgl_daftar) = 2024)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lab_1sehat_v]");
    }
};
