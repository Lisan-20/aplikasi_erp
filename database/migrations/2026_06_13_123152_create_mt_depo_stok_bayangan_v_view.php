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
        DB::statement("CREATE VIEW dbo.mt_depo_stok_bayangan_v
AS
SELECT     dbo.mt_depo_stok_bayangan.kode_depo_stok, dbo.mt_depo_stok_bayangan.kode_brg, dbo.mt_depo_stok_bayangan.jml_sat_kcl, 
                      dbo.mt_depo_stok_bayangan.stok_minimum, dbo.mt_depo_stok_bayangan.stok_maksimum, dbo.mt_bagian.kode_bagian, 
                      dbo.mt_depo_stok_bayangan.kode_rekap_stok, dbo.mt_depo_stok_bayangan.id_kartu
FROM         dbo.mt_depo_stok_bayangan CROSS JOIN
                      dbo.mt_bagian
WHERE     (dbo.mt_bagian.kode_bagian IN ('010101', '010201', '010301', '010401', '010601', '010701', '010901', '011001', '011101', '011501', '011701', '011801', '012201', 
                      '012301', '020101', '030001', '030102', '030103', '030104', '030105', '030106', '030107', '030108', '030109', '030110', '030111', '030112', '030113', '030501', 
                      '030601', '030701', '030901', '031001', '032001', '050101', '050201', '060101'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_bayangan_v]");
    }
};
