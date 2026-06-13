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
        DB::statement("CREATE VIEW dbo.xx_update_anestesi
AS
SELECT     bill_rs, bill_dr1, detail, kode, keterangan, bill_rs - bill_dr1 AS bill_rs_update
FROM         dbo.mt_master_tarif_detail_bedah_bpjs
WHERE     (detail = 'Penata Anestesi')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xx_update_anestesi]");
    }
};
