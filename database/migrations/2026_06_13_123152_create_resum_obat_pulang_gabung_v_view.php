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
        DB::statement("CREATE OR ALTER VIEW dbo.resum_obat_pulang_gabung_v
AS
SELECT     dbo.resum_obat_pulang_v.no_registrasi, dbo.resum_obat_pulang_v.nama_tindakan, dbo.resum_obat_pulang_v.kode_barang
FROM         dbo.resum_obat_pulang_v INNER JOIN
                      dbo.mt_barang ON dbo.resum_obat_pulang_v.kode_barang = dbo.mt_barang.kode_brg
WHERE     (dbo.resum_obat_pulang_v.flag_obt_plang IS NULL) AND (dbo.resum_obat_pulang_v.flag_perawat IS NULL) AND (dbo.mt_barang.flag_medis <> 1)
GROUP BY dbo.resum_obat_pulang_v.no_registrasi, dbo.resum_obat_pulang_v.nama_tindakan, dbo.resum_obat_pulang_v.kode_barang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_obat_pulang_gabung_v]");
    }
};
