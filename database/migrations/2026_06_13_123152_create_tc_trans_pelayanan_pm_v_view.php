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
        DB::statement("

CREATE VIEW dbo.tc_trans_pelayanan_pm_v
AS
SELECT     kode_penunjang, status_selesai AS status_selesai_bayar, kode_bagian_asal
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_penunjang, status_selesai, kode_bagian_asal


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_pm_v]");
    }
};
