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
        DB::statement("CREATE OR ALTER VIEW dbo.mapping_update_v
AS
SELECT     TOP (100) PERCENT kode_mapping_transaksi, kode_bagian, kode_proses, kode_jenis_proses, acc_debet, acc_kredit, keterangan, no_urut, kode_bagian_asal, 
                      '0' + kode_bagian AS bag_update
FROM         dbo.mapping_transaksi
WHERE     (kode_proses = 2) AND (kode_bagian LIKE '3%')
ORDER BY kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mapping_update_v]");
    }
};
