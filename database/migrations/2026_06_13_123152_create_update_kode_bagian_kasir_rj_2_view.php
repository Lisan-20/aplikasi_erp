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
        DB::statement("CREATE VIEW dbo.update_kode_bagian_kasir_rj_2
AS
SELECT     dbo.tran_kasir.kode_bagian AS bagian_kasir, dbo.v_cek_bagian_pelayanan_2.kode_bagian AS kode_bagian_pelayanan, dbo.v_cek_bagian_kasir_2.kode_bagian, 
                      dbo.v_cek_bagian_kasir_2.kode_tc_trans_kasir, dbo.v_cek_bagian_pelayanan_2.kode_bagian_asal
FROM         dbo.v_cek_bagian_kasir_2 INNER JOIN
                      dbo.v_cek_bagian_pelayanan_2 ON dbo.v_cek_bagian_kasir_2.kode_tc_trans_kasir = dbo.v_cek_bagian_pelayanan_2.kode_tc_trans_kasir AND 
                      dbo.v_cek_bagian_kasir_2.kode_bagian <> dbo.v_cek_bagian_pelayanan_2.kode_bagian AND 
                      dbo.v_cek_bagian_kasir_2.no_registrasi = dbo.v_cek_bagian_pelayanan_2.no_registrasi INNER JOIN
                      dbo.tran_kasir ON dbo.v_cek_bagian_pelayanan_2.kode_tc_trans_kasir = dbo.tran_kasir.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_bagian_kasir_rj_2]");
    }
};
