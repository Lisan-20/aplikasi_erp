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
        DB::statement("CREATE VIEW dbo.inp_fee_dr1_jamkesmas_temp_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, 
                      dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dr, dbo.tc_trans_pelayanan.kode_bagian, 
                      (CASE WHEN dbo.tc_trans_pelayanan.diskon_dr1 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr1 END) AS diskon_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 7) AND (dbo.tc_trans_pelayanan.kode_perusahaan = 0 OR
                      dbo.tc_trans_pelayanan.kode_perusahaan IS NULL) AND (dbo.tc_trans_pelayanan.flag_dr1 IS NULL) AND (dbo.tc_trans_pelayanan.kode_dokter1 > 0) AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.kode_dokter1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [inp_fee_dr1_jamkesmas_temp_v]");
    }
};
