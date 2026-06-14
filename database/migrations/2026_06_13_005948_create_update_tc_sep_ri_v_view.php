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
        DB::statement("CREATE OR ALTER VIEW dbo.update_tc_sep_ri_v
AS
SELECT     MAX(no) AS no, tgl_masuk, tgl_pulang, no_mr, nama_pasien, no_sep, kode_cbg, topup, total_tarif, tarif_rs, jenis
FROM         dbo.tc_sep_ri_temp
GROUP BY tgl_masuk, tgl_pulang, no_mr, nama_pasien, no_sep, kode_cbg, topup, total_tarif, tarif_rs, jenis
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tc_sep_ri_v]");
    }
};
