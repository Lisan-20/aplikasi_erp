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
        DB::statement("CREATE OR ALTER VIEW dbo.update_nonm_v
AS
SELECT     nomor_permintaan, CAST('0' + nomor_permintaan AS varchar) AS OK, LEFT(nomor_permintaan, 2) AS OKK, id_tc_permintaan_inst
FROM         dbo.tc_permintaan_inst_nm
WHERE     (id_tc_permintaan_inst >= 100)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_nonm_v]");
    }
};
