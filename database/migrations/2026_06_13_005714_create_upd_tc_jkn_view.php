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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tc_jkn
AS
SELECT     dbo.tc_registrasi.plafon_bpjs, dbo.tran_kasir.seri_kuitansi, dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.kode, dbo.tran_kasir.jumlah, dbo.tran_kasir.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tran_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tran_kasir.no_registrasi
WHERE     (dbo.tran_kasir.kode = 5) AND (dbo.tc_registrasi.plafon_bpjs > 0) AND (dbo.tran_kasir.no_registrasi IN (169615, 173537, 172408, 173832, 174001, 178464, 165266, 
                      168032))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tc_jkn]");
    }
};
