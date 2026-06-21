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
        DB::statement("CREATE OR ALTER VIEW dbo.update_man_lagi_v
AS
SELECT     dbo.tran_sed.kode_trans_sed, dbo.tran_sed.no_registrasi, dbo.tran_sed.no_kunjungan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, dbo.tran_sed.no_kuitansi, dbo.tran_sed.tx_nominal_old, 
                      dbo.tran_sed.jumlah, dbo.tran_sed.jenis_tindakan, dbo.tran_sed.acc_no, dbo.tran_sed.tipe, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.kode_barang, 
                      dbo.tran_sed.nama_tindakan, dbo.tran_sed.tgl_jam, dbo.tran_sed.tgl_proses, dbo.tran_sed.kode_dr, dbo.tran_sed.kode_trans_far, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_bagian_asal, 
                      dbo.tran_sed.kode_trans_pelayanan, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.tran_sed.kode_tarif, dbo.tran_sed.flag_jurnal, dbo.tran_sed.tgl_input, 
                      dbo.tran_sed.kd_tr_resep, dbo.tran_sed.harga_beli, dbo.tran_sed.vol, dbo.tran_sed.tx_nominal, dbo.tran_sed.id_jenis_layanan, dbo.tc_registrasi.kode_bagian_masuk
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_registrasi ON dbo.tran_sed.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tran_sed.kode_bagian IS NULL) AND (dbo.tran_sed.seri_kuitansi IN ('RI', 'AI'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_man_lagi_v]");
    }
};
