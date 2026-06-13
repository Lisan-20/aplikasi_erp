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
        DB::statement("CREATE VIEW dbo.upd_kode_kelompok
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.kode_kelompok AS Expr1
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_kelompok IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_kelompok]");
    }
};
