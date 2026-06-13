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
        DB::statement("CREATE VIEW dbo.cek_kode_bagian_kosong_v
AS
SELECT     persen, kode_bagian, jenis_tindakan, kode_plafon
FROM         dbo.v_c1
WHERE     (kode_bagian NOT IN
                          (SELECT     kode_bagian
                            FROM          dbo.tc_trans_pelayanan
                            WHERE      (no_registrasi = 146594) AND (status_batal IS NULL)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_kode_bagian_kosong_v]");
    }
};
