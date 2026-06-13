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
        DB::statement("CREATE VIEW dbo.list_kuitansi_sktm_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_kuitansi_bendahara, 
                      dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, 
                      dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.no_debet, dbo.tc_trans_kasir.kredit, 
                      dbo.tc_trans_kasir.no_kredit, dbo.tc_trans_kasir.cetak_kartu, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.status_batal
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_registrasi.kode_kelompok = 6) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_kuitansi_sktm_v]");
    }
};
