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
        DB::statement("CREATE VIEW dbo.dash_farmasi_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.fr_hisbebasluar_v.tgl_trans) AS thn, MONTH(dbo.fr_hisbebasluar_v.tgl_trans) AS bln, DAY(dbo.fr_hisbebasluar_v.tgl_trans) AS tgl, 
                      COUNT(dbo.fr_hisbebasluar_v.kd_tr_resep) AS jml, dbo.fr_hisbebasluar_v.petugas, dbo.mt_karyawan.nama_pegawai, dbo.dash_farmasi_detail_v.nama_bagian, 
                      dbo.dash_farmasi_detail_v.kode_bagian, dbo.fr_hisbebasluar_v.kode_brg, dbo.mt_barang.nama_brg, SUM(dbo.fr_hisbebasluar_v.jumlah_tebus) AS jumlah_tebus, 
                      dbo.mt_barang.satuan_kecil, dbo.fr_hisbebasluar_v.kode_trans_far
FROM         dbo.fr_hisbebasluar_v INNER JOIN
                      dbo.dash_farmasi_detail_v ON dbo.fr_hisbebasluar_v.kode_trans_far = dbo.dash_farmasi_detail_v.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_hisbebasluar_v.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.fr_hisbebasluar_v.petugas = dbo.mt_karyawan.no_induk
GROUP BY YEAR(dbo.fr_hisbebasluar_v.tgl_trans), MONTH(dbo.fr_hisbebasluar_v.tgl_trans), DAY(dbo.fr_hisbebasluar_v.tgl_trans), dbo.fr_hisbebasluar_v.petugas, 
                      dbo.mt_karyawan.nama_pegawai, dbo.dash_farmasi_detail_v.nama_bagian, dbo.dash_farmasi_detail_v.kode_bagian, dbo.fr_hisbebasluar_v.kode_brg, 
                      dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.fr_hisbebasluar_v.kode_trans_far
ORDER BY dbo.fr_hisbebasluar_v.kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_farmasi_v]");
    }
};
