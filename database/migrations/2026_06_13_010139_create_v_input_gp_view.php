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
        DB::statement("CREATE OR ALTER VIEW dbo.v_input_gp
AS
SELECT     dbo.data_pokok_pegawai_v.nama_pegawai, dbo.data_pokok_pegawai_v.nama_bagian, dbo.data_pokok_pegawai_v.npp, dbo.data_pokok_pegawai_v.nama_bank, 
                      dbo.GajiKaryawanJan2016.GajiPokok, dbo.GajiKaryawanJan2016.[Bagian ], dbo.data_pokok_pegawai_v.no_induk, dbo.data_pokok_pegawai_v.no_rekening, 
                      dbo.GajiKaryawanJan2016.[ TunjJabatan] AS TunjJabatan, dbo.GajiKaryawanJan2016.[TunjKhusus ] AS TunjKhusus, dbo.GajiKaryawanJan2016.TunjLevel, 
                      dbo.GajiKaryawanJan2016.[TunjPin ] AS TunjPIN, dbo.GajiKaryawanJan2016.[TunjPrestasi ] AS TunjPrestasi, dbo.GajiKaryawanJan2016.[TunjKehadiran ] AS TunjKehadiran, 
                      dbo.GajiKaryawanJan2016.LainLain AS TunjLain, dbo.GajiKaryawanJan2016.PotJamsostek, dbo.GajiKaryawanJan2016.PotAsramaKopDll AS PotAsrama, dbo.GajiKaryawanJan2016.GajiBersih
FROM         dbo.data_pokok_pegawai_v INNER JOIN
                      dbo.GajiKaryawanJan2016 ON dbo.data_pokok_pegawai_v.nama_pegawai = dbo.GajiKaryawanJan2016.Nama
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_input_gp]");
    }
};
