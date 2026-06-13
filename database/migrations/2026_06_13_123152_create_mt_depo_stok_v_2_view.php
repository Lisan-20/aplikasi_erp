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
        DB::statement("CREATE VIEW dbo.mt_depo_stok_v_2
AS
SELECT     dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_depo_stok.stok_maksimum
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_bagian ON dbo.mt_depo_stok.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_depo_stok.stok_maksimum
HAVING      (dbo.mt_depo_stok.kode_brg > '0') AND (dbo.mt_depo_stok.jml_sat_kcl < dbo.mt_depo_stok.stok_minimum)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_v_2]");
    }
};
