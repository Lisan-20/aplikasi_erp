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
        DB::statement("CREATE VIEW dbo.cek_dobel_retur_pel_v
AS
SELECT     status_kredit, MIN(kode_trans_pelayanan) AS kode, jumlah, kd_his
FROM         dbo.tc_trans_pelayanan
GROUP BY status_kredit, jumlah, kd_his
HAVING      (status_kredit = 1) AND (COUNT(kd_his) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_dobel_retur_pel_v]");
    }
};
