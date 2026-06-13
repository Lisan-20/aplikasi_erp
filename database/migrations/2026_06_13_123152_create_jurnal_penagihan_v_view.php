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
        DB::statement("CREATE VIEW dbo.jurnal_penagihan_v
AS
SELECT     dbo.verifikasi_penagihan_v2.no_invoice_tagih, dbo.verifikasi_penagihan_v2.tgl, dbo.verifikasi_penagihan_v2.jumlah, 
                      (CASE WHEN dbo.verifikasi_penagihan_v2.diskon IS NULL THEN 0 ELSE dbo.verifikasi_penagihan_v2.diskon END) AS diskon, 
                      dbo.verifikasi_penagihan_v2.petugas, dbo.verifikasi_penagihan_v2.tgl_input, dbo.verifikasi_penagihan_v2.tgl_jt_tempo, 
                      dbo.verifikasi_penagihan_v2.kode_perusahaan, dbo.verifikasi_penagihan_v2.tgl_ver, dbo.verifikasi_penagihan_v2.status_ver, 
                      dbo.verifikasi_penagihan_v2.id_tc_tagih, dbo.verifikasi_penagihan_v2.nama_perusahaan, dbo.mapping_transaksi_rs_v.kode_proses, 
                      dbo.mapping_transaksi_rs_v.nama_proses, dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.kode_bagian
FROM         dbo.verifikasi_penagihan_v2 CROSS JOIN
                      dbo.mapping_transaksi_rs_v
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 9)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_penagihan_v]");
    }
};
