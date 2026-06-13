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
        DB::statement("CREATE VIEW dbo.dokter_resep_ri_v
AS
SELECT     dbo.resum_obat_pulang_v.no_registrasi, dbo.resum_obat_pulang_v.kode_dokter, dbo.mt_karyawan.nama_pegawai
FROM         dbo.resum_obat_pulang_v INNER JOIN
                      dbo.mt_karyawan ON dbo.resum_obat_pulang_v.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.resum_obat_pulang_v.no_registrasi, dbo.resum_obat_pulang_v.kode_dokter, dbo.mt_karyawan.nama_pegawai
HAVING      (dbo.resum_obat_pulang_v.no_registrasi > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dokter_resep_ri_v]");
    }
};
