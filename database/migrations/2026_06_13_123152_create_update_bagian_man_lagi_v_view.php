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
        DB::statement("CREATE VIEW dbo.update_bagian_man_lagi_v
AS
SELECT     dbo.tran_kasir.kode_tran_kasir, dbo.tran_kasir.kode_tc_trans_kasir, dbo.tran_kasir.no_registrasi, dbo.tran_kasir.no_mr, dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.seri_kuitansi, 
                      dbo.tran_kasir.no_induk, dbo.tran_kasir.tgl_jam, dbo.tran_kasir.jumlah_old, dbo.tran_kasir.kode_bagian, dbo.tran_kasir.flag_jurnal, dbo.tran_kasir.tgl_proses, dbo.tran_kasir.kode, 
                      dbo.tran_kasir.kode_perusahaan, dbo.tran_kasir.jumlah, dbo.tran_kasir.npp, dbo.tc_registrasi.kode_bagian_masuk
FROM         dbo.tran_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tran_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tran_kasir.seri_kuitansi = 'UM')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bagian_man_lagi_v]");
    }
};
