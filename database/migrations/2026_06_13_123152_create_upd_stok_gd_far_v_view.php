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
        DB::statement("CREATE VIEW dbo.upd_stok_gd_far_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, dbo.mt_depo_stok.kode_brg AS Expr1, dbo.mt_depo_stok.jml_sat_kcl, dbo.tc_kartu_stok.stok_awal, dbo.tc_kartu_stok.keterangan
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_depo_stok.kode_brg = dbo.tc_kartu_stok.kode_brg
WHERE     (dbo.mt_depo_stok.kode_brg IN
                          (SELECT     kode_brg
                            FROM          dbo.tc_kartu_stok AS tc_kartu_stok_1
                            WHERE      (keterangan LIKE '%33/RK/VI/2018%'))) AND (dbo.mt_depo_stok.kode_bagian = 060201) AND (dbo.tc_kartu_stok.keterangan LIKE '%33/RK/VI/2018%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_stok_gd_far_v]");
    }
};
