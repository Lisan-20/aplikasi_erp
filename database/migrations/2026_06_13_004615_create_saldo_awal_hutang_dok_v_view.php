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
        DB::statement("CREATE OR ALTER VIEW dbo.saldo_awal_hutang_dok_v
AS
SELECT     dbo.saldo_awal_hutang_dr.kd_saldo_awal_hutang, dbo.saldo_awal_hutang_dr.tgl_input, dbo.saldo_awal_hutang_dr.tgl_saldo_awal, 
                      dbo.saldo_awal_hutang_dr.kode_dokter, dbo.saldo_awal_hutang_dr.tgl_jt, dbo.saldo_awal_hutang_dr.saldo_awal, 
                      dbo.saldo_awal_hutang_dr.no_induk, dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.saldo_awal_hutang_dr INNER JOIN
                      dbo.mt_karyawan ON dbo.saldo_awal_hutang_dr.kode_dokter = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_hutang_dok_v]");
    }
};
