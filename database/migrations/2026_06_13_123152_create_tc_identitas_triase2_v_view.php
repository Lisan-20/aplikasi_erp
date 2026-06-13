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
        DB::statement("CREATE VIEW dbo.tc_identitas_triase2_v
AS
SELECT     dbo.tc_identitas_triase.nama_pasien, dbo.tc_identitas_triase.umur, dbo.tc_identitas_triase.id, dbo.tc_pemeriksaan_erm.no_mr, dbo.tc_identitas_triase.id_triase, dbo.tc_identitas_triase.alamat, 
                      dbo.tc_identitas_triase.tgl_input, dbo.tc_identitas_triase.warna, dbo.tc_identitas_triase.kat_triase, dbo.tc_identitas_triase.user_id, dbo.tc_identitas_triase.keluhan_utama, 
                      dbo.tc_identitas_triase.jen_kel, dbo.tc_pemeriksaan_erm.no_registrasi
FROM         dbo.tc_identitas_triase INNER JOIN
                      dbo.tc_pemeriksaan_erm ON dbo.tc_identitas_triase.id = dbo.tc_pemeriksaan_erm.id_triase
GROUP BY dbo.tc_identitas_triase.nama_pasien, dbo.tc_identitas_triase.umur, dbo.tc_identitas_triase.id, dbo.tc_pemeriksaan_erm.no_mr, dbo.tc_identitas_triase.id_triase, dbo.tc_identitas_triase.alamat, 
                      dbo.tc_identitas_triase.tgl_input, dbo.tc_identitas_triase.warna, dbo.tc_identitas_triase.kat_triase, dbo.tc_identitas_triase.user_id, dbo.tc_identitas_triase.keluhan_utama, 
                      dbo.tc_identitas_triase.jen_kel, dbo.tc_pemeriksaan_erm.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_identitas_triase2_v]");
    }
};
