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
        DB::statement("CREATE VIEW dbo.dash_penerimaan_kasir_v
AS
SELECT     dbo.tc_trans_kasir.status_batal, CASE WHEN tunai IS NULL THEN 0 ELSE tunai END AS tunai, CASE WHEN debet IS NULL THEN 0 ELSE debet END AS debet, 
                      CASE WHEN kredit IS NULL THEN 0 ELSE kredit END AS kredit, CASE WHEN nk IS NULL THEN 0 ELSE nk END + CASE WHEN nk_perusahaan IS NULL 
                      THEN 0 ELSE nk_perusahaan END AS nota_kredit, CASE WHEN nd IS NULL THEN 0 ELSE nd END AS nota_debet, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_trans_kasir LEFT OUTER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_penerimaan_kasir_v]");
    }
};
