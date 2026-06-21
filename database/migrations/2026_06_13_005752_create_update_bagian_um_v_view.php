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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bagian_um_v
AS
SELECT     dbo.ks_tc_trans_um.id_tc_trans_um, dbo.ks_tc_trans_um.kode_tc_trans_kasir, dbo.ks_tc_trans_um.no_registrasi, dbo.ks_tc_trans_um.no_kunjungan, dbo.ks_tc_trans_um.no_mr, 
                      dbo.ks_tc_trans_um.nama_pasien, dbo.ks_tc_trans_um.kode_bagian, dbo.ks_tc_trans_um.kd_kuitansi, dbo.ks_tc_trans_um.no_kuitansi, dbo.ks_tc_trans_um.tunai, dbo.ks_tc_trans_um.debit, 
                      dbo.ks_tc_trans_um.kredit, dbo.ks_tc_trans_um.jumlah, dbo.ks_tc_trans_um.kd_bank_cc, dbo.ks_tc_trans_um.kd_bank_dc, dbo.ks_tc_trans_um.tgl_bayar, dbo.ks_tc_trans_um.tgl_eod, 
                      dbo.ks_tc_trans_um.flag_jurnal, dbo.ks_tc_trans_um.kode_tc_trans_kasir_bayar, dbo.ks_tc_trans_um.tgl_ver, dbo.ks_tc_trans_um.user_ver, dbo.ks_tc_trans_um.status_batal, 
                      dbo.tc_registrasi.kode_bagian_masuk
FROM         dbo.ks_tc_trans_um INNER JOIN
                      dbo.tc_registrasi ON dbo.ks_tc_trans_um.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.ks_tc_trans_um.kode_bagian = '' OR
                      dbo.ks_tc_trans_um.kode_bagian IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bagian_um_v]");
    }
};
