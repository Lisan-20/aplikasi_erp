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
        DB::statement("CREATE OR ALTER VIEW dbo.trans_sed_v
AS
SELECT     kode_trans_sed, no_registrasi, no_kunjungan, no_mr, seri_kuitansi, no_kuitansi, tx_nominal, jumlah, jenis_tindakan, acc_no, tipe, kode, kode_tc_trans_kasir, 
                      kode_barang, nama_tindakan, tgl_jam, tgl_proses, kode_dr, kode_trans_far, kode_bagian, kode_bagian_asal, kode_trans_pelayanan, kode_kelompok, 
                      kode_perusahaan, kode_tarif, flag_jurnal, tgl_input
FROM         dbo.tran_sed
WHERE     (tx_nominal > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_sed_v]");
    }
};
