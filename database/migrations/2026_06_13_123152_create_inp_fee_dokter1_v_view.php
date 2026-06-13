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
        DB::statement("CREATE VIEW dbo.inp_fee_dokter1_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_klas, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_dr2_jatah, 
                      dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.bill_dr3, dbo.tc_trans_pelayanan.kode_dokter3
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.flag_dr1 IS NULL) AND (dbo.tc_trans_pelayanan.kode_kelompok = 1) AND (dbo.tc_trans_pelayanan.kode_perusahaan = 0 OR
                      dbo.tc_trans_pelayanan.kode_perusahaan IS NULL) AND (MONTH(dbo.tc_trans_kasir.tgl_jam) >= 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [inp_fee_dokter1_v]");
    }
};
