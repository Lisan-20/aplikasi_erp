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
        DB::statement("CREATE VIEW dbo.tindakan_usg_kebidanan_v
AS
SELECT     kode_tarif, SUM(jumlah) AS jumlah, no_registrasi
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_bagian = '010101')
GROUP BY kode_tarif, no_registrasi, status_batal
HAVING      (kode_tarif IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif
                            WHERE      (nama_tarif LIKE '%USG%') AND (kode_bagian = '010101'))) AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tindakan_usg_kebidanan_v]");
    }
};
