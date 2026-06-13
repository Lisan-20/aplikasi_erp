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
        DB::statement("CREATE VIEW dbo.upd_cahaya_real_v
AS
SELECT     dbo.mt_pola_tarif.kode_tarif, dbo.Sheet6$.Nama_tindakan, dbo.mt_pola_tarif.bill_rs, dbo.mt_pola_tarif.bill_dr1, dbo.mt_pola_tarif.kode_klas, 
                      dbo.Sheet6$.bill_rs AS bill_rs_n, dbo.Sheet6$.bill_dr, dbo.Sheet6$.kd_bagian, dbo.mt_pola_tarif.kode_perusahaan
FROM         dbo.mt_pola_tarif LEFT OUTER JOIN
                      dbo.Sheet6$ ON dbo.mt_pola_tarif.kode_tarif = dbo.Sheet6$.kd_tarif
WHERE     (dbo.mt_pola_tarif.kode_perusahaan = 296) AND (dbo.mt_pola_tarif.kode_klas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_cahaya_real_v]");
    }
};
