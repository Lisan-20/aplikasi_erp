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
        DB::statement("CREATE OR ALTER VIEW dbo.verifikasi_penagihan_v2
AS
SELECT     no_invoice_tagih, jenis_tagih, tgl, petugas, tgl_input, tgl_jt_tempo, tgl_ver, status_ver, nama_perusahaan, id_tc_tagih, jumlah, diskon, kode_perusahaan
FROM         dbo.verifikasi_penagihan_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [verifikasi_penagihan_v2]");
    }
};
