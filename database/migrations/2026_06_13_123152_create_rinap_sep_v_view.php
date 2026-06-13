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
        DB::statement("CREATE VIEW dbo.rinap_sep_v
AS
SELECT     CONVERT(VARCHAR(10), tgl_masuk, 110) AS tgl_masuk, CONVERT(VARCHAR(10), tgl_keluar, 110) AS tgl_keluar, no_kunjungan, plafon_bpjs, code_inacbg, kode_ri
FROM         dbo.ri_tc_rawatinap
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rinap_sep_v]");
    }
};
