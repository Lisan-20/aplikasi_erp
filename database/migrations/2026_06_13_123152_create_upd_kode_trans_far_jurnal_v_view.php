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
        DB::statement("CREATE VIEW dbo.upd_kode_trans_far_jurnal_v
AS
SELECT     dbo.tran_sed.kode_trans_far, dbo.tran_sed.kd_tr_resep, dbo.tc_trans_pelayanan.kd_tr_resep AS kd_tr_resep_trans, 
                      dbo.tc_trans_pelayanan.kode_trans_far AS kode_trans_far_trans
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tran_sed.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.tc_trans_pelayanan.kode_trans_far > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_trans_far_jurnal_v]");
    }
};
