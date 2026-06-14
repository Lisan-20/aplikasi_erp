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
        DB::statement("CREATE OR ALTER VIEW dbo.v_bill_fisio_bpjs_fee
AS
SELECT     no_mr, no_registrasi, SUM(fee) AS fee, tgl_jam, no_kunjungan, kode_kelompok, kode_bagian, kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, nama_pasien, 
                      kode_paramedis, flag_alat, nama_tindakan
FROM         dbo.v_bill_fisio_bpjs
GROUP BY no_mr, no_registrasi, tgl_jam, no_kunjungan, kode_kelompok, kode_bagian, kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, nama_pasien, kode_paramedis, 
                      flag_alat, nama_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bill_fisio_bpjs_fee]");
    }
};
