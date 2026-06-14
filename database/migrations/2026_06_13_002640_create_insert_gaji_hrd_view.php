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
        DB::statement("CREATE OR ALTER VIEW dbo.insert_gaji_hrd
AS
SELECT     TOP (100) PERCENT dbo.upd_gapok.flag_update, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.npp, 1 AS id_kd_transaksi_det, dbo.upd_gapok.GAPOK, 
                      'Gaji Pokok' AS uraian_transaksi, 1 AS id_kd_transaksi, 0 AS status_id
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.upd_gapok ON dbo.mt_karyawan.npp = dbo.upd_gapok.NPP
ORDER BY dbo.upd_gapok.GAPOK DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [insert_gaji_hrd]");
    }
};
