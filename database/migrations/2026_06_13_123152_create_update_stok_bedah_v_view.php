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
        DB::statement("CREATE OR ALTER VIEW dbo.update_stok_bedah_v
AS
SELECT     dbo.mt_depo_stok.*, dbo.mt_depo_stok_bedah.jml_sat_kcl AS baru
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_depo_stok_bedah ON dbo.mt_depo_stok.kode_brg = dbo.mt_depo_stok_bedah.kode_brg AND 
                      dbo.mt_depo_stok.kode_bagian = dbo.mt_depo_stok_bedah.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_stok_bedah_v]");
    }
};
