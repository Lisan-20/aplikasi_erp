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
        DB::statement("CREATE VIEW dbo.tc_trans_kasir_unuion_v
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, no_kuitansi_bendahara, no_induk, tgl_jam, no_mr, no_registrasi, bill, tambahan, potongan, tunai, debet, no_debet, kredit, no_kredit, cetak_kartu, nd, 
                      nk, nk_karyawan, nk_perusahaan, nk_askes, no_mr_karyawan, kode_perusahaan, no_batch_cc, kd_bank_cc, kd_bank_dc, no_batch_dc, pembulatan, nama_pasien, pembayar, keterangan, 
                      kd_inv_umum_tx, kd_inv_askes, kd_inv_persh_tx, kd_inv_kary_tx, flag_jurnal, tgl_ver, user_ver, kd_inv_cc_tx, kd_inv_dc_tx, kode_shift, kode_loket, materai, kode_bagian, status_batal, tgl_batal, 
                      user_batal, seri_kuitansi_batal, no_kuitansi_batal, no_kui_gabung, nk_bpjs, plafon, rl_bag, flag_tagih, npp, selisih_bpjs, flag_rm, user_kirim_rm, tgl_kirim_rm, kode_penanggung, 
                      kode_kelompok
FROM         tc_trans_kasir_penanggung
UNION
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, no_kuitansi_bendahara, no_induk, tgl_jam, no_mr, no_registrasi, bill, tambahan, potongan, tunai, debet, no_debet, kredit, no_kredit, cetak_kartu, nd, 
                      nk, nk_karyawan, nk_perusahaan, nk_askes, no_mr_karyawan, kode_perusahaan, no_batch_cc, kd_bank_cc, kd_bank_dc, no_batch_dc, pembulatan, nama_pasien, pembayar, keterangan, 
                      kd_inv_umum_tx, kd_inv_askes, kd_inv_persh_tx, kd_inv_kary_tx, flag_jurnal, tgl_ver, user_ver, kd_inv_cc_tx, kd_inv_dc_tx, kode_shift, kode_loket, materai, kode_bagian, status_batal, tgl_batal, 
                      user_batal, seri_kuitansi_batal, no_kuitansi_batal, no_kui_gabung, nk_bpjs, plafon, rl_bag, flag_tagih, npp, selisih_bpjs, flag_rm, user_kirim_rm, tgl_kirim_rm, kode_penanggung, 
                      kode_kelompok
FROM         tc_trans_kasir_nk_perusahaan_penanggung
UNION
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, no_kuitansi_bendahara, no_induk, tgl_jam, no_mr, no_registrasi, bill, tambahan, potongan, tunai, debet, no_debet, kredit, no_kredit, cetak_kartu, nd, 
                      nk, nk_karyawan, nk_perusahaan, nk_askes, no_mr_karyawan, kode_perusahaan, no_batch_cc, kd_bank_cc, kd_bank_dc, no_batch_dc, pembulatan, nama_pasien, pembayar, keterangan, 
                      kd_inv_umum_tx, kd_inv_askes, kd_inv_persh_tx, kd_inv_kary_tx, flag_jurnal, tgl_ver, user_ver, kd_inv_cc_tx, kd_inv_dc_tx, kode_shift, kode_loket, materai, kode_bagian, status_batal, tgl_batal, 
                      user_batal, seri_kuitansi_batal, no_kuitansi_batal, no_kui_gabung, nk_bpjs, plafon, rl_bag, flag_tagih, npp, selisih_bpjs, flag_rm, user_kirim_rm, tgl_kirim_rm, kode_penanggung, 
                      kode_kelompok
FROM         tc_trans_kasir_tanpa_penanggung
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_unuion_v]");
    }
};
