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
        DB::statement("CREATE OR ALTER VIEW dbo.fisioterapis_v
AS
SELECT     kode_dokter1, kode_penunjang, kode_bagian, no_kunjungan
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_dokter1, kode_penunjang, kode_bagian, no_kunjungan
HAVING      (kode_bagian = '050301')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fisioterapis_v]");
    }
};
