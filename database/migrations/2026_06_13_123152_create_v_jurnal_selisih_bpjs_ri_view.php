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
        DB::statement("CREATE OR ALTER VIEW dbo.v_jurnal_selisih_bpjs_ri
AS
SELECT     no, tgl_masuk, tgl_pulang, no_mr, nama_pasien, no_sep, kode_cbg, topup, total_tarif, tarif_rs, jenis, CAST(((CASE WHEN tarif_rs IS NULL THEN 0 ELSE tarif_rs END)) - CASE WHEN tarif_rs IS NULL 
                      THEN 0 ELSE tarif_rs END * 0.25 AS int) AS bill_non_adm
FROM         dbo.tc_sep_ri_temp
WHERE     (jenis = 'RI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_selisih_bpjs_ri]");
    }
};
