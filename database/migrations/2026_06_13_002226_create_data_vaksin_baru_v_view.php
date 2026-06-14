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
        DB::statement("CREATE OR ALTER VIEW dbo.data_vaksin_baru_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.fr_tc_far.tgl_trans, dbo.mt_bagian.nama_bagian, dbo.fr_tc_far.no_mr, 
                      dbo.fr_tc_far.nama_pasien, dbo.mt_master_pasien.jen_kelamin, dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.nama_ibu, dbo.mt_master_pasien.nama_ayah, dbo.tc_registrasi.umur, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.mt_nasabah.nama_kelompok, dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.mt_nasabah RIGHT OUTER JOIN
                      dbo.mt_barang INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_barang.kode_brg = dbo.tc_kartu_stok.kode_brg INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_kartu_stok.kode_trans_far = dbo.fr_tc_far.kode_trans_far INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far ON 
                      dbo.mt_nasabah.kode_kelompok = dbo.tc_trans_pelayanan.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_pelayanan.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan RIGHT OUTER JOIN
                      dbo.tc_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr RIGHT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND dbo.mt_master_pasien.no_mr = dbo.tc_trans_kasir.no_mr ON 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_barang = 'D01A02435')
GROUP BY dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.fr_tc_far.tgl_trans, dbo.mt_bagian.nama_bagian, dbo.fr_tc_far.no_mr, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, 
                      dbo.fr_tc_far.nama_pasien, dbo.mt_master_pasien.nama_ibu, dbo.mt_master_pasien.nama_ayah, dbo.tc_registrasi.umur, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.mt_nasabah.nama_kelompok, dbo.mt_perusahaan.nama_perusahaan
ORDER BY dbo.mt_bagian.nama_bagian, dbo.fr_tc_far.tgl_trans, dbo.tc_trans_pelayanan.nama_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_vaksin_baru_v]");
    }
};
