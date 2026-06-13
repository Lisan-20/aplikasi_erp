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
        DB::statement("CREATE VIEW dbo.admin_tarifruang_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.group_bag, dbo.mt_bagian.jumlah_kamar, dbo.mt_bagian.harga_kamar, 
                      dbo.mt_bagian.kelompok_unit, dbo.mt_bagian.validasi, dbo.mt_klas.nama_klas, dbo.mt_bagian.id_mt_bagian, dbo.mt_master_tarif_ruangan.kd_tarif_r, dbo.mt_master_tarif_ruangan.harga_r, 
                      dbo.mt_master_tarif_ruangan.jumlah_k, dbo.mt_master_tarif_ruangan.harga_r_l, dbo.mt_master_tarif_ruangan.jumlah_tt, dbo.mt_master_tarif_ruangan.kode_klas, 
                      dbo.mt_master_tarif_ruangan.keterangan, dbo.mt_master_tarif_ruangan.harga_pt_ass, dbo.mt_master_tarif_ruangan.harga_bpjs, dbo.mt_ruangan.no_bed, 
                      dbo.mt_master_tarif_ruangan.kode_ruangan, dbo.mt_master_tarif_ruangan.harga_bpjs_tk
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_master_tarif_ruangan.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_ruangan.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_master_tarif_ruangan.kode_ruangan = dbo.mt_ruangan.kode_ruangan
ORDER BY dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_tarifruang_v]");
    }
};
