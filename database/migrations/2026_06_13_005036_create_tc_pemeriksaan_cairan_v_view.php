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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_cairan_v
AS
SELECT     dbo.tc_pemeriksaan_cairan.no_imbang, dbo.tc_pemeriksaan_cairan.no_registrasi, dbo.tc_pemeriksaan_cairan.no_kunjungan, dbo.tc_pemeriksaan_cairan.tgl_jam, 
                      dbo.tc_pemeriksaan_cairan.kode_bagian, dbo.tc_pemeriksaan_cairan_det.hasil_x AS hasil, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_cairan_det.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_cairan.shift, dbo.tc_pemeriksaan_cairan_det.kode_rm
FROM         dbo.tc_pemeriksaan_cairan_det INNER JOIN
                      dbo.tc_pemeriksaan_cairan ON dbo.tc_pemeriksaan_cairan_det.no_imbang = dbo.tc_pemeriksaan_cairan.no_imbang INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_cairan_det.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_cairan_v]");
    }
};
