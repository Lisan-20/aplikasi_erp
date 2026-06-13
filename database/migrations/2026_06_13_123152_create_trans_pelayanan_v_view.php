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
        DB::statement("CREATE VIEW dbo.trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM(dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2, 
                      dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_kasir.flag_jurnal AS flag_jurnal_kasir
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.cek_billing_kasir_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.cek_billing_kasir_v.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.status_selesai >= 2) AND (dbo.tc_trans_kasir.status_batal IS NULL)
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_kasir.flag_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_pelayanan_v]");
    }
};
