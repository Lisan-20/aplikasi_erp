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
        DB::statement("CREATE VIEW dbo.hari_rawat_v
AS
SELECT     no_kunjungan, no_registrasi, jenis_tindakan, jumlah
FROM         dbo.tc_trans_pelayanan
WHERE     (jenis_tindakan = 1) AND (NOT (kode_bagian IN ('030501', '030901')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hari_rawat_v]");
    }
};
