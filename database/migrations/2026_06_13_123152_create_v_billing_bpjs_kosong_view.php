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
        DB::statement("CREATE VIEW dbo.v_billing_bpjs_kosong
AS
SELECT     TOP (100) PERCENT dbo.v_tran_jkn.no_registrasi, dbo.mt_plafon_bpjs_detail.kode_plafon, dbo.mt_plafon_bpjs_detail.id_jenis_layanan, 
                      dbo.mt_plafon_bpjs_detail.persen, dbo.mt_plafon_bpjs_detail.keterangan
FROM         dbo.v_tran_jkn INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.v_tran_jkn.id_jenis_layanan <> dbo.mt_plafon_bpjs_detail.id_jenis_layanan AND 
                      dbo.v_tran_jkn.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon
GROUP BY dbo.v_tran_jkn.no_registrasi, dbo.mt_plafon_bpjs_detail.kode_plafon, dbo.mt_plafon_bpjs_detail.id_jenis_layanan, dbo.mt_plafon_bpjs_detail.persen, 
                      dbo.mt_plafon_bpjs_detail.keterangan
HAVING      (dbo.mt_plafon_bpjs_detail.id_jenis_layanan NOT IN (1, 2, 3, 4, 5, 6, 13))
ORDER BY dbo.mt_plafon_bpjs_detail.id_jenis_layanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_bpjs_kosong]");
    }
};
