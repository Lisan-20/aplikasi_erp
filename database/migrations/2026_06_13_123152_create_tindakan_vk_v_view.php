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
        DB::statement("CREATE OR ALTER VIEW dbo.tindakan_vk_v
AS
SELECT     kode_tc_trans_kasir, kode_bagian_asal, no_registrasi
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tc_trans_kasir, kode_bagian_asal, no_registrasi
HAVING      (kode_bagian_asal = '030501')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tindakan_vk_v]");
    }
};
