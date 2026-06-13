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
        DB::statement("CREATE VIEW dbo.update_back_v
AS
SELECT     db_17415.dbo.tc_trans_pelayanan.kode_trans_pelayanan, db_17415.dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      db_17415.dbo.tc_trans_pelayanan.no_registrasi, tc_trans_pelayanan_1.kode_tc_trans_kasir AS kasir_upd, 
                      tc_trans_pelayanan_1.no_registrasi AS reg_upd
FROM         db_17415.dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_pelayanan AS tc_trans_pelayanan_1 ON 
                      db_17415.dbo.tc_trans_pelayanan.kode_trans_pelayanan = tc_trans_pelayanan_1.kode_trans_pelayanan AND 
                      db_17415.dbo.tc_trans_pelayanan.kode_tc_trans_kasir <> tc_trans_pelayanan_1.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_back_v]");
    }
};
