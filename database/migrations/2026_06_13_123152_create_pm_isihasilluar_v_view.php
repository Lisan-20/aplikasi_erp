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
        DB::statement("CREATE VIEW dbo.pm_isihasilluar_v
AS
SELECT     dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_bagian, 
                      dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.satuan, 
                      dbo.pm_pemeriksaanpasienluar_v.status_daftar, dbo.pm_pemeriksaanpasienluar_v.kode_trans_pelayanan, 
                      dbo.pm_pemeriksaanpasienluar_v.no_kunjungan, dbo.pm_pemeriksaanpasienluar_v.no_registrasi, dbo.pm_pemeriksaanpasienluar_v.no_mr, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_kelompok, dbo.pm_pemeriksaanpasienluar_v.kode_perusahaan, 
                      dbo.pm_pemeriksaanpasienluar_v.tgl_transaksi, dbo.pm_pemeriksaanpasienluar_v.jenis_tindakan, 
                      dbo.pm_pemeriksaanpasienluar_v.nama_tindakan, dbo.pm_pemeriksaanpasienluar_v.bill_rs, dbo.pm_pemeriksaanpasienluar_v.bill_dr1, 
                      dbo.pm_pemeriksaanpasienluar_v.bill_dr2, dbo.pm_pemeriksaanpasienluar_v.kode_dokter1, dbo.pm_pemeriksaanpasienluar_v.kode_dokter2, 
                      dbo.pm_pemeriksaanpasienluar_v.jumlah, dbo.pm_pemeriksaanpasienluar_v.kode_barang, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_master_tarif_detail, dbo.pm_pemeriksaanpasienluar_v.kode_tarif, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_penunjang, dbo.pm_mt_standarhasil.urutan, dbo.pm_pemeriksaanpasienluar_v.jen_kelamin
FROM         dbo.pm_pemeriksaanpasienluar_v INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.pm_pemeriksaanpasienluar_v.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_isihasilluar_v]");
    }
};
