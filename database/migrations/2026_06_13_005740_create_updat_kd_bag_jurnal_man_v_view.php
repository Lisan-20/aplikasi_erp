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
        DB::statement("CREATE OR ALTER VIEW dbo.updat_kd_bag_jurnal_man_v
AS
SELECT     dbo.tc_registrasi.kode_bagian_masuk, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_bagian_asal, dbo.tran_sed.kode
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_registrasi ON dbo.tran_sed.no_registrasi = dbo.tc_registrasi.no_registrasi AND dbo.tran_sed.no_mr = dbo.tc_registrasi.no_mr
WHERE     (dbo.tran_sed.kode = 19) AND (dbo.tran_sed.kode_bagian IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updat_kd_bag_jurnal_man_v]");
    }
};
