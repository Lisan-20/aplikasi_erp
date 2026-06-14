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
        DB::statement("CREATE OR ALTER VIEW dbo.v_fee_dokter_bpjs_rajal_RI
AS
SELECT     COUNT(dbo.tc_trans_pelayanan.kode_dokter1) AS jumlah_tindakan, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_registrasi.no_mr, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_plafon, 
                      dbo.tc_trans_jkn.id_jenis_layanan, dbo.tc_trans_jkn.persen_bpjs, dbo.tc_trans_jkn.plafon
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_jkn.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_dokter1 > '0')
GROUP BY dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_registrasi.no_mr, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_plafon, dbo.tc_trans_jkn.id_jenis_layanan, dbo.tc_trans_jkn.persen_bpjs, 
                      dbo.tc_trans_jkn.plafon, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_dr1
HAVING      (dbo.tc_registrasi.kode_kelompok = 9) AND (dbo.tc_registrasi.kode_plafon > 0) AND (dbo.tc_trans_jkn.id_jenis_layanan = 6) AND 
                      (NOT (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%')) AND (NOT (dbo.tc_trans_pelayanan.kode_tarif IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah))) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_rajal_RI]");
    }
};
