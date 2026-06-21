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
        DB::statement("CREATE OR ALTER VIEW dbo.pp_v
AS
SELECT     dbo.tc_trans_pelayanan.no_kunjungan, dbo.mt_master_tarif.kode_grup_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pp_v]");
    }
};
