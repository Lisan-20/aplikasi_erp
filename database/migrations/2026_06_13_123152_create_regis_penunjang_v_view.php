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
        DB::statement("CREATE VIEW dbo.regis_penunjang_v
AS
SELECT     kode_tc_trans_kasir, no_registrasi, kode_penunjang, status_selesai
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tc_trans_kasir, no_registrasi, kode_penunjang, status_selesai
HAVING      (kode_penunjang > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [regis_penunjang_v]");
    }
};
