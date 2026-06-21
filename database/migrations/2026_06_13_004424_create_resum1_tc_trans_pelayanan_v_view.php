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
        DB::statement("CREATE OR ALTER VIEW dbo.resum1_tc_trans_pelayanan_v
AS
SELECT     TOP (100) PERCENT no_registrasi, kode_bagian, nama_tindakan, kode_trans_pelayanan
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, kode_bagian, nama_tindakan, kode_trans_pelayanan
HAVING      (kode_bagian IN ('050101'))
ORDER BY kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum1_tc_trans_pelayanan_v]");
    }
};
