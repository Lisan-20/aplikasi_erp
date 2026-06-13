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
        DB::statement("CREATE VIEW dbo.upd_kode_bagian_kasir
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi,
                       dbo.tc_trans_kasir.kode_bagian, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, 
                      dbo.tc_trans_pelayanan.kode_bagian AS kode_bagian_trans
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi AND 
                      dbo.tc_trans_kasir.kode_bagian <> dbo.tc_registrasi.kode_bagian_keluar INNER JOIN
                      dbo.kobag_trans_v ON dbo.tc_registrasi.no_registrasi = dbo.kobag_trans_v.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (MONTH(dbo.tc_trans_kasir.tgl_jam) = 7) AND (dbo.tc_trans_kasir.seri_kuitansi <> 'um') AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AJ', 'RJ'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_bagian_kasir]");
    }
};
