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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_fee_dokter
AS
SELECT     dbo.tc_trans_pelayanan.kode_dokter1, dbo.fee_dokter_rinap_temp.flag_sppu, dbo.tc_trans_pelayanan.flag_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fee_dokter_rinap_temp ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.fee_dokter_rinap_temp.kode_trans_pelayanan
WHERE     (dbo.tc_trans_pelayanan.kode_dokter1 IN ('935', '936', '937')) AND (dbo.fee_dokter_rinap_temp.flag_sppu IS NULL) AND (dbo.fee_dokter_rinap_temp.no_sppu IS NULL)
                       AND (dbo.tc_trans_pelayanan.flag_dr1 = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_fee_dokter]");
    }
};
