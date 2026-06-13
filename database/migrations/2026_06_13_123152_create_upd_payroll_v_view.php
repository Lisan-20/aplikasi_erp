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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_payroll_v
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, 29 AS id_kd_transaksi_det, 'Uang Makan' AS uraian, '2017-01-31 00:00:00.000' AS tgl_akhir, 
                      '2017-01-01 00:00:00.000' AS tgl_awal, 2 AS id_kd_transaksi, 0 AS status, dbo.upd_gapok.[UANG MAKAN]
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.upd_gapok ON dbo.mt_karyawan.npp = dbo.upd_gapok.NPP
WHERE     (dbo.mt_karyawan.npp <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_payroll_v]");
    }
};
