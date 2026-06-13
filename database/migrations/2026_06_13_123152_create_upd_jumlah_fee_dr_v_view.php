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
        DB::statement("CREATE VIEW dbo.upd_jumlah_fee_dr_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.bill_dr1, dbo.fee_dokter_jamkesmas_temp.jumlah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fee_dokter_jamkesmas_temp ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.fee_dokter_jamkesmas_temp.kode_trans_pelayanan
WHERE     (dbo.fee_dokter_jamkesmas_temp.jumlah IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_jumlah_fee_dr_v]");
    }
};
