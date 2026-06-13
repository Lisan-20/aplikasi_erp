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
        DB::statement("CREATE OR ALTER VIEW dbo.v_fee_dokter_bpjs_RI_visit
AS
SELECT     dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_registrasi.no_mr, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_registrasi, dbo.mt_karyawan.kode_spesialisasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (dbo.tc_trans_pelayanan.kode_dokter1 > '0') AND (dbo.tc_registrasi.kode_kelompok = 9) AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 4) AND 
                      (dbo.mt_karyawan.kode_spesialisasi <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_RI_visit]");
    }
};
