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
        DB::statement("CREATE OR ALTER VIEW dbo.sed_obat_bebas_v
AS
SELECT     dbo.fr_tc_far.no_resep, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.fr_tc_far.kode_trans_far, dbo.tc_trans_pelayanan.kode_tc_trans_kasir
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far
GROUP BY dbo.fr_tc_far.no_resep, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.fr_tc_far.kode_trans_far, dbo.tc_trans_pelayanan.kode_tc_trans_kasir
HAVING      (dbo.tc_trans_pelayanan.no_registrasi = 0) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sed_obat_bebas_v]");
    }
};
