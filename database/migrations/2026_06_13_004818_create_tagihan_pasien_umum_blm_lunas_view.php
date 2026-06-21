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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_pasien_umum_blm_lunas
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.nk, 
                      dbo.tc_trans_kasir.kd_inv_umum_tx, dbo.tc_tagih.jumlah_tagih, dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.tc_tagih ON dbo.tc_trans_kasir.kd_inv_umum_tx = dbo.tc_tagih.id_tc_tagih
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'AI') AND (dbo.tc_trans_kasir.nk > 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_kasir.kode_perusahaan IS NULL OR
                      dbo.tc_trans_kasir.kode_perusahaan = 0) AND (dbo.tc_registrasi.kode_kelompok = 1) AND (dbo.tc_tagih.jumlah_tagih IS NULL)
ORDER BY dbo.tc_trans_kasir.tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_pasien_umum_blm_lunas]");
    }
};
