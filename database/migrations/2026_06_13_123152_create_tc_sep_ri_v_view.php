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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sep_ri_v
AS
SELECT     no, tgl_masuk, tgl_pulang, no_mr, nama_pasien, no_sep, kode_cbg, topup, total_tarif, tarif_rs, jenis, MONTH(tgl_masuk) AS bln
FROM         dbo.tc_sep_ri_temp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sep_ri_v]");
    }
};
