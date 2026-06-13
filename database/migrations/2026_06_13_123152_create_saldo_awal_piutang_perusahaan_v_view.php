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
        DB::statement("CREATE VIEW dbo.saldo_awal_piutang_perusahaan_v
AS
SELECT     dbo.saldo_awal_piutang.kd_saldo_awal_piutang, dbo.saldo_awal_piutang.kd_piutang, dbo.saldo_awal_piutang.tgl_input, 
                      dbo.saldo_awal_piutang.tgl_saldo_awal, dbo.saldo_awal_piutang.kode_perusahaan, dbo.saldo_awal_piutang.tgl_jt, 
                      dbo.saldo_awal_piutang.saldo_awal, dbo.saldo_awal_piutang.keterangan, dbo.saldo_awal_piutang.askes, dbo.saldo_awal_piutang.flag_proses, 
                      dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.saldo_awal_piutang INNER JOIN
                      dbo.mt_perusahaan ON dbo.saldo_awal_piutang.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_piutang_perusahaan_v]");
    }
};
