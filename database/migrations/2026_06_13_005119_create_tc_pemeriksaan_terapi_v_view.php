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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_terapi_v
AS
SELECT     dbo.tc_pemeriksaan_terapi.id_mt_kd, dbo.tc_pemeriksaan_terapi.kode_bagian, dbo.tc_pemeriksaan_terapi.no_kunjungan, dbo.tc_pemeriksaan_terapi.kd_lev, dbo.tc_pemeriksaan_terapi.kd_type, 
                      dbo.tc_pemeriksaan_terapi.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_terapi.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_terapi.ket AS ket_hasil, dbo.tc_pemeriksaan_terapi.kode_pemeriksaan, dbo.tc_pemeriksaan_terapi.id_triase, dbo.tc_pemeriksaan_terapi.sekor AS hasil_sekor, 
                      dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_terapi.no_urut, dbo.tc_pemeriksaan_terapi.no_registrasi, 
                      dbo.tc_pemeriksaan_terapi.id_terapi
FROM         dbo.tc_pemeriksaan_terapi INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_terapi.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_terapi.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_terapi_v]");
    }
};
