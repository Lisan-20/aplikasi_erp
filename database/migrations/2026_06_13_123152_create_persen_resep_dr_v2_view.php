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
        DB::statement("CREATE VIEW dbo.persen_resep_dr_v2
AS
SELECT     dbo.persen_resep_dr_v.kode_trans_pelayanan, dbo.persen_resep_dr_v.kode_tc_trans_kasir, dbo.persen_resep_dr_v.no_kunjungan, 
                      dbo.persen_resep_dr_v.no_registrasi, dbo.persen_resep_dr_v.no_mr, dbo.persen_resep_dr_v.nama_pasien_layan, dbo.persen_resep_dr_v.kode_kelompok, 
                      dbo.persen_resep_dr_v.kode_perusahaan, dbo.persen_resep_dr_v.seri_kuitansi, dbo.persen_resep_dr_v.no_kuitansi, dbo.persen_resep_dr_v.tgl_jam, 
                      dbo.persen_resep_dr_v.bill_rs - CASE WHEN dbo.persen_resep_dr_retur_v.bill_rs IS NULL THEN 0 ELSE dbo.persen_resep_dr_retur_v.bill_rs END AS bill_rs, 
                      dbo.persen_resep_dr_v.jumlah - CASE WHEN dbo.persen_resep_dr_retur_v.jumlah IS NULL THEN 0 ELSE dbo.persen_resep_dr_retur_v.jumlah END AS jumlah, 
                      dbo.persen_resep_dr_v.kode_barang, dbo.persen_resep_dr_v.flag_obat, dbo.persen_resep_dr_v.kode_dokter1, dbo.mt_barang.persen_dr, dbo.mt_barang.nama_brg, 
                      dbo.persen_resep_dr_v.nama_tindakan, dbo.persen_resep_dr_v.kode_bagian, dbo.persen_resep_dr_v.tgl_transaksi, dbo.persen_resep_dr_v.kode_bagian_asal, 
                      CAST(dbo.persen_resep_dr_v.bill_rs * dbo.mt_barang.persen_dr / 100 AS int) AS fee_obat
FROM         dbo.mt_barang INNER JOIN
                      dbo.persen_resep_dr_v ON dbo.mt_barang.kode_brg = dbo.persen_resep_dr_v.kode_barang LEFT OUTER JOIN
                      dbo.persen_resep_dr_retur_v ON dbo.persen_resep_dr_v.kode_barang = dbo.persen_resep_dr_retur_v.kode_barang AND 
                      dbo.persen_resep_dr_v.kode_tc_trans_kasir = dbo.persen_resep_dr_retur_v.kode_tc_trans_kasir AND 
                      dbo.persen_resep_dr_v.kd_tr_resep = dbo.persen_resep_dr_retur_v.kd_tr_resep AND 
                      dbo.persen_resep_dr_v.kode_trans_far = dbo.persen_resep_dr_retur_v.kode_trans_far
WHERE     (dbo.persen_resep_dr_v.jumlah - CASE WHEN dbo.persen_resep_dr_retur_v.jumlah IS NULL THEN 0 ELSE dbo.persen_resep_dr_retur_v.jumlah END > 0) AND 
                      (dbo.mt_barang.persen_dr > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [persen_resep_dr_v2]");
    }
};
