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
        DB::statement("CREATE OR ALTER VIEW dbo.insentif_paramedis_vk_all_v
AS
SELECT     no_mr, no_registrasi, tgl_transaksi, kode_tarif, nominal_insentif, nama_tarif, nama_pasien, status_batal, kode_tc_trans_kasir
FROM         dbo.insentif_paramedis_vk_v
union
SELECT     no_mr, no_registrasi, tgl_transaksi, kode_tarif, nominal_insentif, nama_tarif, nama_pasien, status_batal, kode_tc_trans_kasir
FROM         dbo.regis_vk_sum_v

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [insentif_paramedis_vk_all_v]");
    }
};
