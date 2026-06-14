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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_isihasil_v
AS
SELECT dbo.pm_pemeriksaanpasien_v.kode_trans_pelayanan, dbo.pm_pemeriksaanpasien_v.no_registrasi, dbo.pm_pemeriksaanpasien_v.no_mr, dbo.pm_pemeriksaanpasien_v.kode_kelompok, dbo.pm_pemeriksaanpasien_v.kode_perusahaan, dbo.pm_pemeriksaanpasien_v.tgl_transaksi, 
             dbo.pm_pemeriksaanpasien_v.nama_tindakan, dbo.pm_pemeriksaanpasien_v.bill_rs, dbo.pm_pemeriksaanpasien_v.bill_dr1, dbo.pm_pemeriksaanpasien_v.bill_dr2, dbo.pm_pemeriksaanpasien_v.kode_dokter1, dbo.pm_pemeriksaanpasien_v.kode_dokter2, 
             dbo.pm_pemeriksaanpasien_v.jumlah, dbo.pm_pemeriksaanpasien_v.kode_barang, dbo.pm_pemeriksaanpasien_v.kode_penunjang, dbo.pm_pemeriksaanpasien_v.kode_master_tarif_detail, dbo.pm_pemeriksaanpasien_v.status_daftar, dbo.pm_pemeriksaanpasien_v.no_kunjungan, 
             dbo.pm_pemeriksaanpasien_v.jenis_tindakan, dbo.pm_pemeriksaanpasien_v.kode_tarif, dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_bagian, dbo.pm_mt_standarhasil.standar_hasil_wanita, 
             dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.satuan, dbo.pm_mt_standarhasil.urutan, dbo.pm_pemeriksaanpasien_v.jen_kelamin, dbo.pm_mt_standarhasil.flag_std_hasil, dbo.pm_mt_standarhasil.shw_min, dbo.pm_mt_standarhasil.shw_max, 
             dbo.pm_mt_standarhasil.shp_min, dbo.pm_mt_standarhasil.shp_max, dbo.pm_mt_standarhasil.std_text_p, dbo.pm_mt_standarhasil.std_text_l, dbo.pm_pemeriksaanpasien_v.waktu_sampel, dbo.pm_mt_standarhasil.catatan, dbo.order_lis2.hasil, dbo.order_lis2.keterangan
FROM   dbo.pm_pemeriksaanpasien_v INNER JOIN
             dbo.pm_mt_standarhasil ON dbo.pm_pemeriksaanpasien_v.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif LEFT OUTER JOIN
             dbo.order_lis2 ON dbo.pm_pemeriksaanpasien_v.kode_penunjang = dbo.order_lis2.kode_penunjang AND dbo.pm_mt_standarhasil.kode_mt_hasilpm = dbo.order_lis2.kode_mt_hasilpm
WHERE (NOT (dbo.pm_pemeriksaanpasien_v.nama_tindakan LIKE '%administrasi%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_isihasil_v]");
    }
};
