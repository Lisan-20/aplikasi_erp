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
        DB::statement("CREATE VIEW dbo.update_kode_bagian_kasir_rj
AS
SELECT     dbo.v_cek_bagian_pelayanan.kode_bagian, dbo.v_cek_bagian_kasir.kode_bagian AS kode_bagian_kasir, dbo.v_cek_bagian_kasir.kode_tc_trans_kasir, 
                      dbo.v_cek_bagian_pelayanan.no_registrasi
FROM         dbo.v_cek_bagian_kasir INNER JOIN
                      dbo.v_cek_bagian_pelayanan ON dbo.v_cek_bagian_kasir.kode_tc_trans_kasir = dbo.v_cek_bagian_pelayanan.kode_tc_trans_kasir AND 
                      dbo.v_cek_bagian_kasir.no_registrasi = dbo.v_cek_bagian_pelayanan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_bagian_kasir_rj]");
    }
};
