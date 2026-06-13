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
        DB::statement("CREATE VIEW dbo.v_trans_kasir_RJ
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_kuitansi_bendahara, 
                      dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, 
                      dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.no_debet, dbo.tc_trans_kasir.kredit, 
                      dbo.tc_trans_kasir.no_kredit, dbo.tc_trans_kasir.cetak_kartu, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.no_mr_karyawan, dbo.tc_trans_kasir.no_batch_cc, 
                      dbo.tc_trans_kasir.kd_bank_cc, dbo.tc_trans_kasir.kd_bank_dc, dbo.tc_trans_kasir.no_batch_dc, dbo.tc_trans_kasir.pembulatan, dbo.tc_trans_kasir.nama_pasien, 
                      dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.keterangan, dbo.tc_trans_kasir.kd_inv_umum_tx, dbo.tc_trans_kasir.kd_inv_askes, 
                      dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kd_inv_kary_tx, dbo.tc_trans_kasir.flag_jurnal, dbo.tc_trans_kasir.tgl_ver, dbo.tc_trans_kasir.user_ver, 
                      dbo.tc_trans_kasir.kode_shift, dbo.tc_trans_kasir.kode_loket, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.flag_jurnal = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AJ', 'RJ', 'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_kasir_RJ]");
    }
};
