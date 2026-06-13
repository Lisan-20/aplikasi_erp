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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_ri_perawat_v
AS
SELECT        dbo.tc_pemeriksaan_ri.id_mt_kd, dbo.tc_pemeriksaan_ri.kode_bagian, dbo.tc_pemeriksaan_ri.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_ri.kd_type, dbo.tc_pemeriksaan_ri.hasil, dbo.mt_acc_erm.kd_ref, 
                         dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_ri.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_ri.ket AS ket_hasil, dbo.tc_pemeriksaan_ri.kode_pemeriksaan, 
                         dbo.tc_pemeriksaan_ri.id_triase, dbo.tc_pemeriksaan_ri.sekor AS hasil_sekor, dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_ri.no_urut_ews, 
                         dbo.tc_pemeriksaan_ri.no_urut, dbo.tc_pemeriksaan_ri.tgl_update, dbo.tc_pemeriksaan_ri.no_registrasi, dbo.tc_pemeriksaan_ri.no_mr, dbo.tc_pemeriksaan_ri.kode_rm, YEAR(dbo.tc_pemeriksaan_ri.tgl_update) AS thn
FROM            dbo.tc_pemeriksaan_ri INNER JOIN
                         dbo.mt_acc_erm ON dbo.tc_pemeriksaan_ri.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_pemeriksaan_ri.id_mt_kd, dbo.tc_pemeriksaan_ri.kode_bagian, dbo.tc_pemeriksaan_ri.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_ri.kd_type, dbo.tc_pemeriksaan_ri.hasil, dbo.mt_acc_erm.kd_ref, 
                         dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_ri.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_ri.ket, dbo.tc_pemeriksaan_ri.kode_pemeriksaan, dbo.tc_pemeriksaan_ri.id_triase, 
                         dbo.tc_pemeriksaan_ri.sekor, dbo.mt_acc_erm.sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_ri.no_urut_ews, dbo.tc_pemeriksaan_ri.no_urut, dbo.tc_pemeriksaan_ri.tgl_update, 
                         dbo.tc_pemeriksaan_ri.no_registrasi, dbo.tc_pemeriksaan_ri.no_mr, dbo.tc_pemeriksaan_ri.kode_rm, YEAR(dbo.tc_pemeriksaan_ri.tgl_update)
HAVING        (dbo.mt_acc_erm.kd_lev = 3) AND (YEAR(dbo.tc_pemeriksaan_ri.tgl_update) > 2025)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_ri_perawat_v]");
    }
};
