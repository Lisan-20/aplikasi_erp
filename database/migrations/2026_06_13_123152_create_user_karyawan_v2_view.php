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
        DB::statement("CREATE OR ALTER VIEW dbo.user_karyawan_v2
AS
SELECT     dbo.dd_user.id_dd_user, dbo.dd_user.username, dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.no_induk, dbo.dd_user_group.nama_group, 
                      dbo.dd_user_group.id_dd_user_group, dbo.dd_user.status AS status_kary, dbo.mt_karyawan.no_mr, dbo.mt_bagian.kode_bagian, dbo.mt_karyawan.kode_paramedis, 
                      dbo.mt_karyawan.flag_paramedis, dbo.insentif_paramedis_vk_v.no_mr AS no_mr_print, dbo.insentif_paramedis_vk_v.bill_dr1, dbo.insentif_paramedis_vk_v.bill_rs, 
                      dbo.insentif_paramedis_vk_v.kode_tarif, dbo.insentif_paramedis_vk_v.kode_paramedis AS Expr2, dbo.insentif_paramedis_vk_v.tgl_transaksi, dbo.insentif_paramedis_vk_v.status_batal, 
                      dbo.insentif_paramedis_vk_v.no_registrasi, dbo.insentif_paramedis_vk_v.nama_pasien_layan, dbo.insentif_paramedis_vk_v.nama_tindakan
FROM         dbo.dd_user_group INNER JOIN
                      dbo.dd_user ON dbo.dd_user_group.id_dd_user_group = dbo.dd_user.id_dd_user_group CROSS JOIN
                      dbo.mt_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.mt_bagian.kode_bagian = dbo.mt_karyawan.kode_bagian CROSS JOIN
                      dbo.insentif_paramedis_vk_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [user_karyawan_v2]");
    }
};
