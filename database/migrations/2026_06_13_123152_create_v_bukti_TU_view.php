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
        DB::statement("CREATE VIEW dbo.v_bukti_TU
AS
SELECT     TOP (100) PERCENT nomor_permintaan, MONTH(tgl_permintaan) AS bln, YEAR(tgl_permintaan) AS thn, id_tc_permintaan_inst,ROW_NUMBER() OVER(ORDER BY id_tc_permintaan_inst ASC) AS Nomor,bukti_upd
FROM         dbo.tc_permintaan_inst
WHERE     (YEAR(tgl_permintaan) = 2017) AND (nomor_permintaan LIKE '%RS/I%') ORDER BY id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bukti_TU]");
    }
};
