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
        DB::statement("CREATE VIEW dbo.jurnal_pembelian_obat_bebas_v
AS
SELECT     kode_trans_sed, no_registrasi, no_kunjungan, no_mr, seri_kuitansi, jumlah, jenis_tindakan, acc_no, tipe, kode, kode_tc_trans_kasir, kode_barang, nama_tindakan, tgl_jam, tgl_proses, kode_dr_int, 
                      kode_trans_far, kode_bagian, kode_bagian_asal, kode_trans_pelayanan, kode_kelompok, kode_perusahaan, kode_tarif, flag_jurnal, tgl_input, kd_tr_resep, harga_beli, vol, tx_nominal, 
                      id_jenis_layanan, kode_inap, no_kuitansi, kode_dr
FROM         dbo.tran_sed
WHERE     (no_registrasi = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pembelian_obat_bebas_v-baru]");
    }
};
