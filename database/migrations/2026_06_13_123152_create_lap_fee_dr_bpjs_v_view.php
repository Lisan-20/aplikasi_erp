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
        DB::statement("CREATE VIEW dbo.lap_fee_dr_bpjs_v
AS
SELECT     dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.mt_karyawan.nama_pegawai, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.bill_rs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (NOT (dbo.tc_registrasi.kode_kelompok IN ('1', '3', '10', '5')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_fee_dr_bpjs_v]");
    }
};
