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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kebidanan_hamil_v
AS
SELECT     dbo.lap_dokter_harian_v.*, dbo.th_riwayat_pasien.diagnosa_akhir AS diagnosa, dbo.th_riwayat_pasien.kode_icd_diagnosa, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.lap_dokter_harian_v INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.lap_dokter_harian_v.no_mr = dbo.th_riwayat_pasien.no_mr AND 
                      dbo.lap_dokter_harian_v.no_kunjungan = dbo.th_riwayat_pasien.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.lap_dokter_harian_v.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.th_riwayat_pasien.diagnosa_akhir LIKE 'HAMIL%') OR
                      (dbo.th_riwayat_pasien.kode_icd_diagnosa = 111)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kebidanan_hamil_v]");
    }
};
