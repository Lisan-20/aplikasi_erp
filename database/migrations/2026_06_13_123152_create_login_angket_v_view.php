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
        DB::statement("CREATE VIEW dbo.login_angket_v
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_bagian, dbo.mt_karyawan.kode_spesialisasi, dbo.mt_karyawan.tgl_lahir, REPLACE(CONVERT(varchar, dbo.mt_karyawan.tgl_lahir, 103), '/', 
                      '') AS tgl_lhr, dbo.mt_karyawan.kode_dokter, dbo.mt_karyawan.npp, dbo.mt_karyawan_outsourcing.tgl_lahir AS tgl_lahir1, dbo.mt_karyawan_outsourcing.npp AS npp1, 
                      dbo.mt_karyawan_outsourcing.nama_pegawai AS nama_pegawai1, dbo.mt_karyawan_outsourcing.kode_bagian AS kode_bagian1, dbo.mt_karyawan_outsourcing.kode_dokter AS Expr5, 
                      dbo.mt_karyawan_outsourcing.kode_spesialisasi AS Expr6, REPLACE(CONVERT(varchar, dbo.mt_karyawan_outsourcing.tgl_lahir, 103), '/', '') AS tgl_lhr1
FROM         dbo.mt_karyawan FULL OUTER JOIN
                      dbo.mt_karyawan_outsourcing ON dbo.mt_karyawan.npp = dbo.mt_karyawan_outsourcing.npp AND dbo.mt_karyawan.tgl_lahir = dbo.mt_karyawan_outsourcing.tgl_lahir AND 
                      dbo.mt_karyawan.kode_spesialisasi = dbo.mt_karyawan_outsourcing.kode_spesialisasi AND dbo.mt_karyawan.kode_dokter = dbo.mt_karyawan_outsourcing.kode_dokter AND 
                      dbo.mt_karyawan.nama_pegawai = dbo.mt_karyawan_outsourcing.nama_pegawai AND dbo.mt_karyawan.kode_bagian = dbo.mt_karyawan_outsourcing.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [login_angket_v]");
    }
};
