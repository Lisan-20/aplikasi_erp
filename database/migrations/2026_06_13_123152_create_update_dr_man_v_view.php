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
        DB::statement("CREATE VIEW dbo.update_dr_man_v
AS
SELECT     TOP (100) PERCENT UPPER(dbo.master_dokter_rsbh.nama_dokter) AS nama_dokter, UPPER(dbo.mt_karyawan.nama_pegawai) AS pegawai, dbo.master_dokter_rsbh.specialist, 
                      UPPER(dbo.mt_spesialisasi_dokter.nama_spesialisasi) AS Expr1, dbo.mt_karyawan.kode_spesialisasi, dbo.mt_spesialisasi_dokter.kode_spesialisasi AS kode_spesialisasi_upd
FROM         dbo.master_dokter_rsbh INNER JOIN
                      dbo.mt_karyawan ON dbo.master_dokter_rsbh.nama_dokter = dbo.mt_karyawan.nama_pegawai INNER JOIN
                      dbo.mt_spesialisasi_dokter ON dbo.master_dokter_rsbh.specialist = dbo.mt_spesialisasi_dokter.nama_spesialisasi
WHERE     (dbo.mt_karyawan.kode_spesialisasi IS NULL)
ORDER BY nama_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_dr_man_v]");
    }
};
