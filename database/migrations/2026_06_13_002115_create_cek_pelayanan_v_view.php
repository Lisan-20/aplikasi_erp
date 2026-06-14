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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_pelayanan_v
AS
SELECT     no_kunjungan, no_registrasi, jenis_tindakan, status_selesai
FROM         dbo.tc_trans_pelayanan
GROUP BY no_kunjungan, no_registrasi, jenis_tindakan, status_selesai
HAVING      (jenis_tindakan = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pelayanan_v]");
    }
};
