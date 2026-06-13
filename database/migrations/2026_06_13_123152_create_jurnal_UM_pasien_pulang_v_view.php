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
        DB::statement("CREATE VIEW dbo.jurnal_UM_pasien_pulang_v
AS
SELECT     dbo.tran_kasir.kode_tran_kasir, dbo.jurnal_ri_v.kode_tc_trans_kasir, dbo.tran_kasir.no_registrasi, dbo.tran_kasir.no_mr, dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.seri_kuitansi, 
                      dbo.tran_kasir.no_induk, dbo.tran_kasir.tgl_jam, dbo.tran_kasir.jumlah, dbo.tran_kasir.kode_bagian, dbo.tran_kasir.flag_jurnal, dbo.tran_kasir.tgl_proses, dbo.tran_kasir.kode, 
                      dbo.tran_kasir.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_debet AS acc_no, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tran_kasir.kode_inap
FROM         dbo.mapping_transaksi_rs_v INNER JOIN
                      dbo.tran_kasir ON dbo.mapping_transaksi_rs_v.kode_bagian = dbo.tran_kasir.kode_bagian AND dbo.mapping_transaksi_rs_v.kode = dbo.tran_kasir.kode INNER JOIN
                      dbo.jurnal_ri_v ON dbo.tran_kasir.no_registrasi = dbo.jurnal_ri_v.no_registrasi
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 1) AND (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 38)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_UM_pasien_pulang_v]");
    }
};
