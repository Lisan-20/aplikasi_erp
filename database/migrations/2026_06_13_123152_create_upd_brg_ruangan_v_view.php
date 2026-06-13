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
        DB::statement("CREATE VIEW dbo.upd_brg_ruangan_v
AS
SELECT     dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.stok_minimum, dbo.mt_bagian.kode_bagian
FROM         dbo.mt_bagian CROSS JOIN
                      dbo.mt_depo_stok
WHERE     (dbo.mt_bagian.kode_bagian LIKE '03%') AND (dbo.mt_depo_stok.kode_brg IN ('E01A0593', 'E01A1189', 'E01A0155', 'E01A1188', 'E01A1620', 'E01A1071', 'E01A0964', 
                      'E01A0958', 'E01A1665', 'E01A1947', 'E01A1948', 'E01A1115', 'E01A1610', 'E01A0941', 'E01A0942', 'E01A0943'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_brg_ruangan_v]");
    }
};
