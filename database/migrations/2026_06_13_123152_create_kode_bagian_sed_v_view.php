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
        DB::statement("CREATE VIEW dbo.kode_bagian_sed_v
AS
SELECT     kode_tc_trans_kasir, kode_perusahaan, kode_bagian_asal AS kode_bagian
FROM         dbo.tc_trans_pelayanan
WHERE     (flag_jurnal = 0) AND (jenis_tindakan = 1) AND (kode_bagian_asal NOT IN ('030501', '030901', '031001', '032001'))
GROUP BY kode_tc_trans_kasir, kode_perusahaan, kode_bagian_asal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kode_bagian_sed_v]");
    }
};
