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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_per_farmasi_v
AS
SELECT     TOP (100) PERCENT dbo.fr_hisbebasluar_v.kode_trans_far, dbo.fr_hisbebasluar_v.tgl_trans, dbo.fr_hisbebasluar_v.dokter_pengirim, 
                      dbo.fr_hisbebasluar_v.nama_pasien, dbo.fr_hisbebasluar_v.alamat_pasien, dbo.fr_hisbebasluar_v.telpon_pasien, dbo.fr_hisbebasluar_v.status_transaksi, 
                      dbo.fr_hisbebasluar_v.kd_tr_resep, dbo.fr_hisbebasluar_v.kode_brg, dbo.fr_hisbebasluar_v.jumlah_pesan, dbo.fr_hisbebasluar_v.jumlah_tebus, 
                      dbo.fr_hisbebasluar_v.sisa, dbo.fr_hisbebasluar_v.harga_beli, dbo.fr_hisbebasluar_v.harga_jual, dbo.fr_hisbebasluar_v.harga_r, 
                      dbo.fr_hisbebasluar_v.status_kirim, dbo.fr_hisbebasluar_v.kode_profit, dbo.fr_hisbebasluar_v.no_kunjungan, dbo.fr_hisbebasluar_v.no_resep, 
                      dbo.fr_hisbebasluar_v.kode_pesan_resep, dbo.fr_hisbebasluar_v.no_mr, dbo.fr_hisbebasluar_v.jumlah_retur, dbo.fr_hisbebasluar_v.harga_r_retur, 
                      dbo.fr_hisbebasluar_v.kode_bagian, dbo.fr_hisbebasluar_v.petugas, dbo.fr_hisbebasluar_v.kode_dokter, dbo.fr_hisbebasluar_v.no_registrasi, 
                      dbo.fr_hisbebasluar_v.diskon, dbo.mt_barang.kode_pabrik, dbo.mt_barang.nama_brg
FROM         dbo.fr_hisbebasluar_v INNER JOIN
                      dbo.mt_barang ON dbo.fr_hisbebasluar_v.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_pabrik ON dbo.mt_barang.kode_pabrik = dbo.mt_pabrik.kode_pabrik
ORDER BY dbo.fr_hisbebasluar_v.tgl_trans DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_per_farmasi_v]");
    }
};
