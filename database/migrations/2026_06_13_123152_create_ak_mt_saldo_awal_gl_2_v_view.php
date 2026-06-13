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
        DB::statement("
CREATE VIEW dbo.ak_mt_saldo_awal_gl_2_v
AS
SELECT     dbo.ak_mt_saldo_awal_gl.id_akmt_saldo_awal_gl, dbo.ak_mt_saldo_awal_gl.kode_saldo_awal_gl, dbo.ak_mt_saldo_awal_gl.acc_no, 
                      dbo.ak_mt_saldo_awal_gl.nilai_nominal, dbo.ak_mt_saldo_awal_gl.uraian, dbo.ak_mt_saldo_awal_gl.tahun, dbo.ak_mt_saldo_awal_gl.input_id, 
                      dbo.ak_mt_saldo_awal_gl.tgl_input, dbo.ak_mt_saldo_awal_gl.status, dbo.ak_mt_saldo_awal_gl.status_tgl, dbo.mt_account.acc_nama, 
                      dbo.mt_account.acc_type, dbo.mt_account.level_coa, dbo.ak_mt_saldo_awal_gl.bulan
FROM         dbo.ak_mt_saldo_awal_gl INNER JOIN
                      dbo.mt_account ON dbo.ak_mt_saldo_awal_gl.acc_no = dbo.mt_account.acc_no

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_mt_saldo_awal_gl_2_v]");
    }
};
